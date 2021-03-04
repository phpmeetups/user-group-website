<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes;

    const STATUS_ACTIVE = 'active';
    const STATUS_CANCELED = 'canceled';

    const TYPE_PHYSICAL = 'physical';
    const TYPE_ONLINE = 'online';
    const TYPE_HYBRID = 'hybrid';

    protected $fillable = [
        'featured_photo_url',
        'title',
        'starts_at',
        'ends_at',
        'rsvp_starts_at',
        'rsvp_ends_at',
        'type',
        'online_instructions',
        'description',
        'attendee_limit',
        'allowed_guests',
        'status',
    ];

    protected $dates = [
        'starts_at',
        'ends_at',
        'rsvp_starts_at',
        'rsvp_ends_at',
    ];

    /**
     * Event Hosts.
     *
     * @return BelongsToMany
     */
    public function hosts(): BelongsToMany
    {
        return $this->belongsToMany(User::class, EventHost::class);
    }

    /**
     * RSVPs.
     *
     * @return HasMany
     */
    public function rsvps(): HasMany
    {
        return $this->hasMany(RSVP::class);
    }

    /**
     * Venue.
     *
     * @return BelongsToMany
     */
    public function venues(): BelongsToMany
    {
        return $this->belongsToMany(Venue::class);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function getFormattedStartsAtAttribute()
    {
        if ($this->starts_at->isCurrentYear()) {
            return $this->starts_at->format('M j \a\t g:ia');
        }

        return $this->starts_at->format('M j, Y \a\t g:ia');
    }
}
