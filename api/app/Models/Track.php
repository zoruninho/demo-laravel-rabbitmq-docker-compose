<?php

namespace App\Models;

use App\Enums\TrackStatus;
use Database\Factories\TrackFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[UseFactory(TrackFactory::class)]
class Track extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'description',
        'duration',
        'size',
        'status',
    ];

    protected $casts = [
        'status' => TrackStatus::class,
        'duration' => 'integer',
        'size' => 'integer',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
