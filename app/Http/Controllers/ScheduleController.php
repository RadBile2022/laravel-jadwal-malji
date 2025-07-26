<?php

namespace App\Http\Controllers;

use App\Models\rc;
use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //   $scheduleData = [
        //     'selasa' => [
        //         [
        //             'id' => 1,
        //             'time' => "Ba'da Maghrib - Selesai",
        //             'topic' => "Adab Penuntut Ilmu",
        //             'speaker' => "Ustadz Abu Musaad, Lc",
        //             'place' => "Masjid Sulthana"
        //         ],
        //         [
        //             'id' => 2,
        //             'time' => "Ba'da Maghrib - Selesai",
        //             'topic' => "Aqidah Thahawiyah",
        //             'speaker' => "Ustadz H. Ziyad At-Tamimi, S.TH.I., MHI",
        //             'place' => "Umum"
        //         ],
        //         [
        //             'id' => 3,
        //             'time' => "Ba'da Maghrib - Selesai",
        //             'topic' => "Kajian Umum",
        //             'speaker' => "Ustadz Ayyub Nofel Bya'syt",
        //             'place' => "Masjid Al-Muttaqien ABMs",
        //             'isLibur' => true
        //         ]
        //     ],
        //     // Tambahkan lainnya (senin, rabu, kamis, dst)
        // ];

            $allSchedules = Schedule::orderBy('time')->get();

        // Kelompokkan berdasarkan hari
        $scheduleData = $allSchedules->sortBy('position')->groupBy('day');
        return view('schedule.index', compact('scheduleData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(rc $rc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rc $rc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rc $rc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rc $rc)
    {
        //
    }
}
