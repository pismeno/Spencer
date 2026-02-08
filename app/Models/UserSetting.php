<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $fillable = ['user_id', 'option_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function option() {
        return $this->belongsTo(SettingOption::class, 'option_id');
    }
}
