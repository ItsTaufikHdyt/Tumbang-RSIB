<?php

namespace App\Filament\Resources\ChildResource\Pages;

use App\Filament\Resources\ChildResource;
use App\Filament\Resources\ChildResource\Widgets\ChildProgressChart;
use App\Models\EvaluationDetail;
use App\Models\EvaluationSession;
use Filament\Actions;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class EditChild extends EditRecord
{
    protected static string $resource = ChildResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->makeInputEvaluationAction(),

            Actions\Action::make('previewPdf')
                ->label('Preview Laporan')
                ->icon('heroicon-o-eye')
                ->color('info')
                ->url(
                    fn() => route(
                        'children.report.preview',
                        $this->record
                    )
                )
                ->openUrlInNewTab(),

            Actions\DeleteAction::make()
                ->label('Hapus Pasien'),
        ];
    }

    protected function makeInputEvaluationAction(): Actions\Action
    {
        $activities = $this->record
            ->childActivities()
            ->orderBy('activity_no')
            ->get();

        return Actions\Action::make('inputEvaluation')
            ->label('Input Evaluasi')
            ->icon('heroicon-o-clipboard-document-check')
            ->color('success')
            ->modalHeading(
                'Input Evaluasi: ' . $this->record->name
            )
            ->modalDescription(
                'Pilih satu nilai untuk setiap aktivitas anak.'
            )
            ->modalSubmitActionLabel('Simpan Evaluasi')
            ->modalWidth('5xl')
            ->disabled($activities->isEmpty())
            ->tooltip(
                $activities->isEmpty()
                    ? 'Tambahkan aktivitas anak terlebih dahulu.'
                    : null
            )
            ->form([
                Forms\Components\Section::make('Informasi Evaluasi')
                    ->schema([
                        Forms\Components\DatePicker::make(
                            'evaluation_date'
                        )
                            ->label('Tanggal Evaluasi')
                            ->required()
                            ->native(false)
                            ->default(today())
                            ->maxDate(today()),

                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan Terapis')
                            ->placeholder(
                                'Catatan tambahan selama proses evaluasi'
                            )
                            ->rows(2),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Skor Aktivitas')
                    ->description(
                        '0 = dibantu penuh, 3 = 70% dibantu, '
                            . '7 = 30% dibantu, 10 = mandiri.'
                    )
                    ->schema(
                        $activities
                            ->map(
                                fn($activity) => Forms\Components\Radio::make(
                                    "scores.{$activity->id}"
                                )
                                    ->label(
                                        "{$activity->activity_no}. "
                                            . $activity->activity_name
                                    )
                                    ->options([
                                        0 => '0 — Dibantu penuh',
                                        3 => '3 — 70% dibantu',
                                        7 => '7 — 30% dibantu',
                                        10 => '10 — Mandiri',
                                    ])
                                    ->required()
                                    ->inline()
                                    ->inlineLabel(false)
                                    ->columnSpanFull()
                            )
                            ->all()
                    )
                    ->columns(1),
            ])
            ->action(function (array $data): void {
                $activities = $this->record
                    ->childActivities()
                    ->orderBy('activity_no')
                    ->get(['id']);

                if ($activities->isEmpty()) {
                    throw ValidationException::withMessages([
                        'scores' => 'Pasien belum mempunyai aktivitas.',
                    ]);
                }

                $expectedActivityIds = $activities
                    ->pluck('id')
                    ->map(fn($id): string => (string) $id)
                    ->sort()
                    ->values();

                $submittedScores = collect($data['scores'] ?? []);

                $submittedActivityIds = $submittedScores
                    ->keys()
                    ->map(fn($id): string => (string) $id)
                    ->sort()
                    ->values();

                if (
                    $submittedActivityIds->values()->all() !==
                    $expectedActivityIds->values()->all()
                ) {
                    throw ValidationException::withMessages([
                        'scores' => 'Daftar aktivitas tidak valid atau berubah. '
                            . 'Tutup modal, lalu buka kembali.',
                    ]);
                }

                $invalidScoreExists = $submittedScores->contains(
                    fn($score): bool => !in_array(
                        (int) $score,
                        EvaluationDetail::SCORE_OPTIONS,
                        true
                    )
                );

                if ($invalidScoreExists) {
                    throw ValidationException::withMessages([
                        'scores' => 'Nilai skor hanya boleh 0, 3, 7, atau 10.',
                    ]);
                }

                DB::transaction(function () use (
                    $data,
                    $submittedScores
                ): void {
                    $normalizedScores = $submittedScores
                        ->map(fn($score): int => (int) $score);

                    $session = EvaluationSession::query()->create([
                        'child_id' => $this->record->getKey(),
                        'evaluator_id' => Auth::id(),
                        'evaluation_date' => $data['evaluation_date'],
                        'total_score' => $normalizedScores->sum(),
                        'notes' => $data['notes'] ?? null,
                    ]);

                    $details = $normalizedScores
                        ->map(
                            fn(
                                int $score,
                                string|int $activityId
                            ): array => [
                                'activity_id' => (int) $activityId,
                                'score' => $score,
                            ]
                        )
                        ->values()
                        ->all();

                    $session->details()->createMany($details);
                });

                $this->dispatch('evaluation-created');

                Notification::make()
                    ->success()
                    ->title('Evaluasi berhasil disimpan')
                    ->body(
                        'Nilai seluruh aktivitas dan total skor '
                            . 'telah tersimpan.'
                    )
                    ->send();
            });
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ChildProgressChart::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int|array
    {
        return 1;
    }

    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
