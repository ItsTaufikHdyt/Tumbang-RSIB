<?php

namespace App\Filament\Resources\ChildResource\Widgets;

use App\Models\Child;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Model;

class ChildProgressChart extends ChartWidget
{
    protected static ?string $heading = 'Perkembangan Aktivitas';

    protected static ?string $pollingInterval = null;

    protected static ?string $maxHeight = '320px';

    protected int|string|array $columnSpan = 'full';

    public ?Model $record = null;

    public ?string $filter = null;

    protected function getFilters(): ?array
    {
        if (! $this->record instanceof Child) {
            return [];
        }

        $activities = $this->record
            ->childActivities()
            ->orderBy('activity_no')
            ->get();

        return $activities
            ->mapWithKeys(fn ($activity) => [
                (string) $activity->id =>
                    $activity->activity_no . '. ' . $activity->activity_name,
            ])
            ->all();
    }

    protected function getData(): array
    {
        if (! $this->record instanceof Child) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }

        $activityId = $this->filter;

        if (blank($activityId)) {
            $activityId = $this->record
                ->childActivities()
                ->orderBy('activity_no')
                ->value('id');
        }

        if (! $activityId) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }

        $activity = $this->record
            ->childActivities()
            ->whereKey($activityId)
            ->first();

        if (! $activity) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }

        $details = $activity
            ->evaluationDetails()
            ->with('session')
            ->whereHas('session', function ($query) {
                $query->where(
                    'child_id',
                    $this->record->getKey()
                );
            })
            ->get()
            ->sortBy(function ($detail) {
                return sprintf(
                    '%s-%020d',
                    $detail->session->evaluation_date->format('Y-m-d'),
                    $detail->session_id
                );
            })
            ->values();

        return [
            'datasets' => [
                [
                    'label' => $activity->activity_name,

                    'data' => $details
                        ->pluck('score')
                        ->map(fn ($score) => (int) $score)
                        ->all(),

                    'borderWidth' => 2,
                    'pointRadius' => 5,
                    'pointHoverRadius' => 7,
                    'tension' => 0.2,
                    'fill' => false,
                ],
            ],

            'labels' => $details
                ->map(fn ($detail) =>
                    $detail->session
                        ->evaluation_date
                        ->format('d M Y')
                )
                ->all(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,

            /*
             * PENTING:
             *
             * Jangan gunakan:
             *
             * 'maintainAspectRatio' => false
             *
             * jika chart menyebabkan container terus
             * berubah tinggi / scroll loop.
             */
            'maintainAspectRatio' => true,

            /*
             * Atur rasio chart, bukan tinggi canvas secara dinamis.
             */
            'aspectRatio' => 2.5,

            'animation' => [
                'duration' => 300,
            ],

            'interaction' => [
                'mode' => 'index',
                'intersect' => false,
            ],

            'plugins' => [
                'legend' => [
                    'display' => false,
                ],

                'tooltip' => [
                    'enabled' => true,
                ],
            ],

            'scales' => [
                'y' => [
                    'min' => 0,
                    'max' => 10,
                    'beginAtZero' => true,

                    'ticks' => [
                        'stepSize' => 1,
                        'precision' => 0,
                    ],

                    'title' => [
                        'display' => true,
                        'text' => 'Skor',
                    ],
                ],

                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Tanggal Evaluasi',
                    ],
                ],
            ],
        ];
    }
}