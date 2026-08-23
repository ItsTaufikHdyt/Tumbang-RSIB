<?php

namespace App\Filament\Resources\ChildResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class ChildActivitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'childActivities';

    protected static ?string $title = 'Daftar Aktivitas';

    protected static ?string $modelLabel = 'Aktivitas';

    protected static ?string $pluralModelLabel = 'Daftar Aktivitas';

    protected static ?string $recordTitleAttribute = 'activity_name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('activity_no')
                    ->label('Nomor')
                    ->required()
                    ->numeric()
                    ->integer()
                    ->minValue(1)
                    ->unique(
                        table: 'child_activities',
                        column: 'activity_no',
                        ignoreRecord: true,
                        modifyRuleUsing: function (
                            \Illuminate\Validation\Rules\Unique $rule
                        ): \Illuminate\Validation\Rules\Unique {
                            return $rule->where(
                                'child_id',
                                $this->getOwnerRecord()->getKey()
                            );
                        }
                    ),

                Forms\Components\Textarea::make('activity_name')
                    ->label('Nama Aktivitas')
                    ->placeholder('Contoh: Identifikasi warna dasar')
                    ->required()
                    ->rows(2)
                    ->columnSpanFull(),
            ])->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('activity_name')
            ->columns([
                Tables\Columns\TextColumn::make('activity_no')
                    ->label('No.')
                    ->sortable()
                    ->width('80px'),

                Tables\Columns\TextColumn::make('activity_name')
                    ->label('Aktivitas')
                    ->searchable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('evaluation_details_count')
                    ->label('Jumlah Penilaian')
                    ->counts('evaluationDetails')
                    ->badge(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Aktivitas')
                    ->icon('heroicon-o-plus')
                    ->mutateFormDataUsing(
                        function (array $data): array {
                            $data['child_id'] = $this
                                ->getOwnerRecord()
                                ->getKey();

                            return $data;
                        }
                    ),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                Tables\Actions\DeleteAction::make()
                    ->before(function (
                        Tables\Actions\DeleteAction $action,
                        Model $record
                    ): void {
                        if ($record->evaluationDetails()->exists()) {
                            $action->failure();

                            \Filament\Notifications\Notification::make()
                                ->danger()
                                ->title('Aktivitas tidak dapat dihapus')
                                ->body(
                                    'Aktivitas ini sudah memiliki riwayat evaluasi. '
                                    . 'Ubah nama aktivitas atau gunakan mekanisme arsip.'
                                )
                                ->send();

                            $action->cancel();
                        }
                    }),
            ])
            ->bulkActions([
                /*
                 * Bulk delete sengaja tidak dipasang untuk mencegah
                 * riwayat evaluasi ikut terhapus tanpa disadari.
                 */
            ])
            ->defaultSort('activity_no');
    }
}
