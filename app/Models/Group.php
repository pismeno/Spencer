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
class Group extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'group';

    /**
     * The primary key of the user in the table.
     *
     * @var string
     */
    protected $primaryKey = 'group_id';

    /**
     * Indicates if the model should be timestamped. Now disabled as the table does not have required columns.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'group_id' => 'integer',
            'created_at' => 'datetime',
        ];
    }

    /**
     * Get the memberships of users for this group.
     *
     * @return HasMany
     */
    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class, 'group_id', 'group_id');
    }
}
