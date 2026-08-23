<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChildResource\Pages;
use App\Filament\Resources\ChildResource\RelationManagers;
use App\Models\Child;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChildResource extends Resource
{
    protected static ?string $model = Child::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Pasien Anak';

    protected static ?string $modelLabel = 'Pasien Anak';

    protected static ?string $pluralModelLabel = 'Pasien Anak';

    protected static ?string $navigationGroup = 'Tumbuh Kembang';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identitas Anak')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Anak')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('place_of_birth')
                            ->label('Tempat Lahir')
                            ->maxLength(255),

                        Forms\Components\DatePicker::make('date_of_birth')
                            ->label('Tanggal Lahir')
                            ->required()
                            ->native(false)
                            ->maxDate(now()),

                        Forms\Components\Select::make('gender')
                            ->label('Jenis Kelamin')
                            ->options([
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                            ])
                            ->native(false),

                        Forms\Components\TextInput::make('father')
                            ->label('Nama Ayah')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('mother')
                            ->label('Nama Ibu')
                            ->maxLength(255),

                        Forms\Components\Textarea::make('address')
                            ->label('Alamat')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(
                fn(Builder $query): Builder => $query
                    ->withCount([
                        'childActivities',
                        'evaluationSessions',
                    ])
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Anak')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('date_of_birth')
                    ->label('Tanggal Lahir')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('gender')
                    ->label('Jenis Kelamin')
                    ->formatStateUsing(
                        fn(?string $state): string => match ($state) {
                            'L' => 'Laki-laki',
                            'P' => 'Perempuan',
                            default => '-',
                        }
                    )
                    ->badge(),

                Tables\Columns\TextColumn::make('child_activities_count')
                    ->label('Aktivitas')
                    ->counts('childActivities')
                    ->badge(),

                Tables\Columns\TextColumn::make('evaluation_sessions_count')
                    ->label('Evaluasi')
                    ->counts('evaluationSessions')
                    ->badge(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Terdaftar')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Kelola'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('name');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ChildActivitiesRelationManager::class,

            RelationManagers\TreatmentCertificatesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChildren::route('/'),
            'create' => Pages\CreateChild::route('/create'),
            'edit' => Pages\EditChild::route('/{record}/edit'),
        ];
    }
}
