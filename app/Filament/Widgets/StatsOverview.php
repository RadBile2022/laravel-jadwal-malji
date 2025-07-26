<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $baseUrl = 'https://kajian.malangmengaji.com/admin/schedules?day=';
        
        return [
            Stat::make('Jadwal Kajian', 'Senin')->url($baseUrl . 'senin'),
            Stat::make('Jadwal Kajian', 'Selasa')->url($baseUrl . 'selasa'),
            Stat::make('Jadwal Kajian', 'Rabu')->url($baseUrl . 'rabu'),
            Stat::make('Jadwal Kajian', 'Kamis')->url($baseUrl . 'kamis'),
            Stat::make('Jadwal Kajian', 'Jumat')->url($baseUrl . 'jumat'),
            Stat::make('Jadwal Kajian', 'Sabtu')->url($baseUrl . 'sabtu'),
            Stat::make('Jadwal Kajian', 'Ahad')->url($baseUrl . 'ahad'),
        ];
    }
}