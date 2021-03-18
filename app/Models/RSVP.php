<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RSVP extends Model
{
    use HasFactory;

    const STATUS_YES = 'yes';
    const STATUS_NO = 'no';

    protected $table = 'rsvps';

    protected $fillable = [
        'event_id',
        'user_id',
        'status',
    ];

    protected $with = [
        'user',
    ];

    /**
     * Event.
     *
     * @return BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * User.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeYes(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_YES);
    }
}
