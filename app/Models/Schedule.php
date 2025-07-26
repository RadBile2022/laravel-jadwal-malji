<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
        protected $fillable = [
    	'day',
        'time_id',
        'time',
        'position',
        'topic_id',
        'topic',
        'speaker_id',
        'speaker',
        'place_id',
        'place',
        'information',
        'information_systems',
        'is_shown'
    ];

    protected $casts = [
        'is_free' => 'boolean',
        'is_shown' => 'boolean',
        'information_systems' => 'array',
    ];

    // Relasi opsional, bisa tambahkan jika kamu punya model-model tersebut
    public function time()
    {
        return $this->belongsTo(Time::class, 'time_id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function speaker()
    {
        return $this->belongsTo(Speaker::class, 'speaker_id');
    }

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }
}
