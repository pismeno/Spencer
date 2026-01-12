<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Membership extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'group_membership';

    /**
     * The primary key of the user in the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function group(): HasOne
    {
        return $this->hasOne(Group::class, 'group_id', 'group_id');
    }
}
