<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * @property int $user_id
 * @property string $email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * * @method static Builder|static query()
 * @method static Builder|static create(array $attributes = [])
 */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The primary key of the user in the table.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

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
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'created_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the memberships in groups of this user.
     *
     * @return HasMany
     */
    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class);
    }
}
