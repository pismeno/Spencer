<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

abstract class ReadOnlyModel extends Model
{
    /**
     * Indicates if the model should be timestamped. Now disabled as the table does not have required columns.
     *
     * @var bool
     */
    public $timestamps = false;

    protected static function boot(): void
    {
        parent::boot();

        // Prevent any creation, update, or deletion
        static::creating(function ($model) {
            throw new Exception("The Role model is read-only. Predefined roles must be managed via migrations.");
        });

        static::updating(function ($model) {
            throw new Exception("The Role model is read-only.");
        });

        static::deleting(function ($model) {
            throw new Exception("The Role model is read-only.");
        });
    }
}
