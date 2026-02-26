<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|static create(array $attributes = [])
 */

class Event extends Model
{

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'starts_at',
        'ends_at',
        'group_id', //TODO Groupy
        'img_path'
    ];

    protected function casts(): array
    {
        return [
            'event_id' => 'integer',
            'created_at' => 'datetime',
            'deadline' => 'datetime',
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'group_id' => 'integer'
        ];
    }

    /**
     * Get the memberships of users for this group.
     *
     * @return HasMany
     */
    // public function memberships(): HasMany
    // {
    //     return $this->hasMany(Membership::class, 'group_id', 'group_id');
    // }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
