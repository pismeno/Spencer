<?php

namespace App\Models;

use App\Enums\Roles;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends ReadOnlyModel
{
    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class, 'role_id', 'id');
    }

    public static function fromEnum(Roles $enumEntry): Role
    {
        return self::where('name', $enumEntry->value)->firstOrFail();
    }
}
