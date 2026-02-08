<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{   
    protected $fillable = ['name'];

    // Relationships
    public function options() {
        return $this->hasMany(SettingOption::class);
    }
}
