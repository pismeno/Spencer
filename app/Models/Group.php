<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    // Memberships within this group
    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class, 'group_id', 'group_id');
    }
}
