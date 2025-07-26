<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Filament\Resources\ScheduleResource\Pages\CreateSchedule;
use App\Filament\Resources\ScheduleResource\RelationManagers;
use App\Models\Schedule;
use App\Models\Place;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TagsColumn;


class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';
    
    protected static ?string $navigationGroup = 'Data Base';
    protected static ?string $navigationLabel = 'Jadwal Kajian';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
    //             Forms\Components\Select::make('day')
    // ->label('Hari')
    // ->options([
    //     'senin' => 'Senin',
    //     'selasa' => 'Selasa',
    //     'rabu' => 'Rabu',
    //     'kamis' => 'Kamis',
    //     'jumat' => 'Jumat',
    //     'sabtu' => 'Sabtu',
    //     'ahad' => 'Ahad',
    // ])
    // ->required()
    // ->reactive(),
// Forms\Components\TextInput::make('day')->label('Hari')
//     ->default(fn () => request()->get('day'))
//     ->disabled()->dehydrated(true),
// Di form field
Forms\Components\TextInput::make('day')
    ->label('Hari')
    ->default(fn (CreateSchedule $livewire) => $livewire->day)
    ->readOnly()
    ->dehydrated(true),




                // Forms\Components\TextInput::make('time_id')
                //     ->numeric()
                //     ->default(null),
                // Forms\Components\TextInput::make('time')
                //     ->maxLength(255)
                //     ->label('Waktu')
                //     ->required(),
                Forms\Components\Select::make('time_id')
    ->label('Waktu')
    ->options(fn () => \App\Models\Time::pluck('name', 'id'))
    ->searchable()
    ->required(),
                // Forms\Components\TextInput::make('topic_id')
                //     ->numeric()
                //     ->default(null),
                Forms\Components\TextInput::make('topic')
                    ->maxLength(255)
                    ->label('Tema')
                    ->required(),
                // Forms\Components\TextInput::make('speaker_id')
                //     ->numeric()
                //     ->default(null),
                // Forms\Components\TextInput::make('speaker')
                //     ->maxLength(255)
                //     ->default(null),
                // Forms\Components\TextInput::make('place_id')
                //     ->numeric()
                //     ->default(null),
                // Forms\Components\TextInput::make('place')
                //     ->maxLength(255)
                //     ->default(null),
    

Forms\Components\Select::make('speaker_id')
    ->label('Ustadz')
    ->options(fn () => \App\Models\Speaker::pluck('name', 'id'))
    ->searchable()
    ->required(),
Forms\Components\Select::make('place_id')
    ->label('Tempat')
    ->options(fn () => \App\Models\Place::pluck('name', 'id'))
    ->searchable()
    ->required(),

Forms\Components\Select::make('information_systems')
    ->label('Keterangan Kajian')
    ->multiple()
    ->minItems(1)
    ->options([
        'Rutin Pekanan' => 'Rutin Pekanan',
        'Pekan 1' => 'Pekan 1',
        'Pekan 2' => 'Pekan 2',
        'Pekan 3' => 'Pekan 3',
        'Pekan 4' => 'Pekan 4',
        'Pekan 5' => 'Pekan 5',])
    ->required()
    ->reactive(),

Forms\Components\Select::make('is_shown')
    ->label('Apakah Ditampilkan ?')
    ->options([
        true => 'Iya',
        false => 'Tidak',
    ])
    ->required()
    ->default(false)
    ->reactive(),
                Forms\Components\Select::make('information')
                    ->label('Keterangan')
                    ->required()
                    ->options([
                        'Kajian Umum' => 'Umum',
                        'Libur' => 'Libur',
                        'Khusus Ikhwan' => 'Khusus Ikhwan',
                        'Khusus Akhwat' => 'Khusus Akhwat'
                    ])
                    // ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
                ->columns([
                Tables\Columns\TextColumn::make('day')->label('Hari')
                    ->searchable()->badge(),
                Tables\Columns\TextColumn::make('is_shown')
                    ->label('Apakah Ditampilkan ?')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Ya' : 'Tidak') // Ubah boolean ke teks 'Ya'/'Tidak'
                    ->colors([
                        'success' => true,  // Jika state-nya true, warnanya success
                        'danger' => false, // Jika state-nya false, warnanya danger
                    ])
                    ->sortable(),
                TagsColumn::make('information_systems')
                        ->label('Keterangan Kajian')->sortable(),

                Tables\Columns\TextColumn::make('time')->label('Waktu')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('topic')->label('Tema')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('speaker')->label('Pemateri')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('place')->label('Tempat')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }
    
public static function configureTable(Table $table): void
{
    $day = request()->get('day');
    dd($day);

    if ($day) {
        $dayFormatted = ucfirst(strtolower($day));

        // 1. Filter query supaya hanya hari itu
        $table->query(fn (Builder $query) => $query->where('day', $dayFormatted));

        // 2. Pastikan parameter day tetap ada di URL setiap request (sort, page, etc)
        $table->modifyQueryStringUsing(fn (array $params) => array_merge($params, [
            'day' => $dayFormatted,
        ]));
    }
}



//     public static function beforeCreate($record, array $data): void
// {
//     $place = \App\Models\Place::find($data['place_id']);
//     $record->place = $place?->name ?? null;
// }

// public static function beforeUpdate($record, array $data): void
// {
//     $place = \App\Models\Place::find($data['place_id']);
//     $record->place = $place?->name ?? null;
// }

}
