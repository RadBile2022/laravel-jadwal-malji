<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;

// use App\Models\Kajian;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;


Route::get('/sitemap.xml', function () {
    return response()->file(public_path('sitemap.xml'));
});


Route::get('/generate-sitemap', function () {
    $sitemap = Sitemap::create();

    $sitemap->add(Url::create('/'));
    $sitemap->add(Url::create('/kajian'));
    $sitemap->add(Url::create('/pemateri'));

    // Kajian::all()->each(function ($kajian) use ($sitemap) {
    //     $sitemap->add(Url::create("/kajian/{$kajian->slug}"));
    // });

    $sitemap->writeToFile(public_path('sitemap.xml'));

    return 'Sitemap dinamis berhasil dibuat!';
});


Route::get('/', [ScheduleController::class, 'index']);


Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/jadwal-kajian', function(){
    return view('template');
});