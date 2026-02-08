<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * @property int $user_id
 * @property string $email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|static query()
 * @method static Builder|static create(array $attributes = [])
 * @method static whereLike(string $string, string $string1)
 */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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

    protected function casts(): array {
        return ['password' => 'hashed',];
    }

    /**
     * Get the memberships in groups of this user.
     *
     * @return HasMany
     */
    public function memberships(): HasMany {
        return $this->hasMany(Membership::class);
    }

    /**
     * The groups that the user belongs to.
     *
     * @return BelongsToMany
     */
    public function groups(): BelongsToMany {
        return $this->belongsToMany(Group::class, 'memberships', 'user_id', 'group_id');
    }
}
