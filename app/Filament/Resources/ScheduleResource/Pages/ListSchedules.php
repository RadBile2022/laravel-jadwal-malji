<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListSchedules extends ListRecords
{
    protected static string $resource = ScheduleResource::class;

    protected function getHeaderActions(): array
    {
         return [
        Actions\CreateAction::make()
            ->url(fn () => ScheduleResource::getUrl('create', ['day' => request('day')])),
    ];
        // return [
        //     Actions\CreateAction::make(),
        // ];
    }
    protected function getTableActions(): array
{
    return [
        Actions\EditAction::make()
            ->url(fn ($record) => ScheduleResource::getUrl('edit', [
                'record' => $record,
                'day' => $record->day, // ← penting: bawa day dari data
            ])),
    ];
}

     protected function getTableQuery(): Builder
    {
        $query = parent::getTableQuery();

        if ($day = request()->query('day')) {
            $query->where('day', $day);
        }

        return $query;
    }
    
        protected function getTableQueryString(): array
    {
        $params = parent::getTableQueryString();

        if ($day = request()->query('day')) {
            $params['day'] = $day;
        }

        return $params;
    }
    
    
    
}
