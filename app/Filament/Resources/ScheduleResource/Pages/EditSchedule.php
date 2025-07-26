<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Place;
use App\Models\Speaker;
use App\Models\Time;
class EditSchedule extends EditRecord
{
    protected static string $resource = ScheduleResource::class;

protected function getRedirectUrl(): string
{
    return ScheduleResource::getUrl('index', ['day' => $this->record->day]);
}
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
 public function mount($record): void
{
    parent::mount($record);

    // Jika ?day tidak ada, redirect dengan menambahkan day dari record
    if (!request()->has('day')) {
        $day = $this->record->day;

        // Kembalikan redirect response
        $this->redirect(ScheduleResource::getUrl('edit', [
            'record' => $this->record,
            'day' => $day,
        ]));
    }
}

    
    
    
    protected function afterSave(): void
{
   $record = $this->record;

        // Update 'place' berdasarkan place_id
        if ($record->place_id) {
            $place = Place::find($record->place_id);

            if ($place) {
                $record->place = $place->name;
                $record->place_address = $place->address;
                $record->link_map = $place->map;
            }
        }

        // Update 'speaker' berdasarkan speaker_id
        if ($record->speaker_id) {
            $speaker = Speaker::find($record->speaker_id);

            if ($speaker) {
                $record->speaker = $speaker->name;
            }
        }

   // Update 'speaker' berdasarkan speaker_id
        if ($record->time_id) {
            $time = Time::find($record->time_id);

            if ($time) {
                $record->time = $time->name;
                $record->position = $time->position;
            }
        }


        $record->save();
}

}
