<?php

namespace App\Filament\Resources\ChildResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TreatmentCertificatesRelationManager extends RelationManager
{
    protected static string $relationship = 'treatmentCertificates';

    protected static ?string $title =
        'Surat Keterangan Dalam Perawatan';

    protected static ?string $modelLabel =
        'Surat Keterangan';

    protected static ?string $pluralModelLabel =
        'Surat Keterangan';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
               Forms\Components\Section::make(
                    'Data Surat'
                )
                    ->schema([
                        Forms\Components\TextInput::make(
                            'letter_number'
                        )
                            ->label('Nomor Surat')
                            ->placeholder(
                                'Contoh: 001/SK/TSK/VIII/2026'
                            )
                            ->maxLength(255),

                        Forms\Components\DatePicker::make(
                            'letter_date'
                        )
                            ->label('Tanggal Surat')
                            ->default(today())
                            ->required()
                            ->native(false),

                        Forms\Components\TextInput::make(
                            'diagnosis'
                        )
                            ->label('Diagnosis dr. Rehab')
                            ->placeholder('Contoh: ASD')
                            ->maxLength(255),

                        Forms\Components\Textarea::make(
                            'statement'
                        )
                            ->label('Keterangan')
                            ->default(
                                'Ananda masih menjalani therapy '
                                . 'di Smart Kids RSIB sampai sekarang.'
                            )
                            ->rows(4)
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make(
                            'signer_name'
                        )
                            ->label('Nama Penanggung Jawab')
                            ->default(
                                'Muhamad Sawali, S.Ft, Ftr, '
                                . 'NDT, SIPT, M.K.M'
                            )
                            ->required(),

                        Forms\Components\TextInput::make(
                            'signer_title'
                        )
                            ->label('Jabatan Penanggung Jawab')
                            ->default(
                                'Penanggung Jawab Layanan '
                                . 'TUMBANG Smart Kids RSIB'
                            )
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('letter_number')
            ->columns([
                Tables\Columns\TextColumn::make(
                    'letter_number'
                )
                    ->label('Nomor Surat')
                    ->placeholder('-')
                    ->searchable(),

                Tables\Columns\TextColumn::make(
                    'letter_date'
                )
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make(
                    'diagnosis'
                )
                    ->label('Diagnosis')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make(
                    'creator.name'
                )
                    ->label('Dibuat Oleh')
                    ->placeholder('-'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Buat Surat')
                    ->icon('heroicon-o-document-plus')
                    ->mutateFormDataUsing(
                        function (array $data): array {
                            $data['created_by'] = Auth::id();

                            return $data;
                        }
                    ),
            ])
            ->actions([
                Tables\Actions\Action::make('preview')
                    ->label('Preview')
                    ->icon('heroicon-o-eye')
                    ->url(
                        fn ($record) => route(
                            'treatment-certificates.preview',
                            $record
                        )
                    )
                    ->openUrlInNewTab(),

                Tables\Actions\EditAction::make(),

                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort(
                'letter_date',
                'desc'
            );
            
    }
}
