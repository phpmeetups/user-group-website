<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Returns a collection of RSVPs, including both yes and no responses.
     *
     * @return HasMany
     */
    public function rsvps(): HasMany
    {
        return $this->hasMany(RSVP::class);
    }

    /**
     * Returns a collection of the events the user is hosting, including those in the past.
     *
     * @return BelongsToMany
     */
    public function hosting(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, EventHost::class);
    }
}
