<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Place;
use App\Models\Speaker;
use App\Models\Schedule;
use App\Models\Time;
class CreateSchedule extends CreateRecord
{
    protected static string $resource = ScheduleResource::class;
    
     public ?string $day = null;
    
protected function afterCreate(): void
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
        
          // Update 'time' berdasarkan time_id
        if ($record->time_id) {
            $time = Time::find($record->time_id);

            if ($time) {
                $record->time = $time->name;
                $record->position = $time->position;
            }
        }

        $record->save();
        
        
    }

protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['day'] = $this->day;
    return $data;
}


//  protected function mutateFormDataBeforeCreate(array $data): array
//     {
//         if (request()->has('day')) {
//             $data['day'] = request()->get('day');
//         }

//         return $data;
//     }

    protected function getFormDefaults(): array
    {
        return [
            'day' => request()->get('day'),
        ];
    }
    
public function mount(?string $day = null): void
{
    $this->day = $day ?? request()->get('day');

    parent::mount();

    $this->form->fill([
        'day' => $this->day,
    ]);
}

    protected function shouldCreateAnother(): bool
{
    return filled($this->data['should_create_another'] ?? false);
}

    
    
protected function getRedirectUrl(): string
{
    if ($this->shouldCreateAnother()) {
        return static::getResource()::getUrl('create', ['day' => $this->day]);
    }

    return static::getResource()::getUrl();
}

protected function getLivewireQueryString(): array
{
    return [
        'day' => ['except' => null],
    ];
}


}
