<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends ReadOnlyModel
{
    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class, 'role_id', 'id');
    }
}
