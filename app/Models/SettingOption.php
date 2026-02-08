<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingOption extends Model
{      
    protected $fillable = ['setting_id', 'option_data'];


    // Relationships
    public function setting() {
        return $this->belongsTo(Setting::class);
    }

    public function userSettings() {
        return $this->belongsTo(UserSetting::class);
    }
}
