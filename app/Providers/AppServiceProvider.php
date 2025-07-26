<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use App\Filament\Resources\ScheduleResource;
use Filament\Navigation\NavigationItem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::serving(function () {
    $days = ['senin', 'selasa', 'rabu', 'kamis', 'jumat','sabtu','ahad'];

    foreach ($days as $day) {
        Filament::registerNavigationItems([
            NavigationItem::make(ucfirst($day))
                ->label(ucfirst($day))
                ->url(ScheduleResource::getUrl('index', ['day' => $day]))
                ->icon('heroicon-o-calendar')
                ->group('Jadwal Harian')
                ->isActiveWhen(function () use ($day) {
                    return request('day') === $day;
                }),
        ]);
    }
});

    }
}
