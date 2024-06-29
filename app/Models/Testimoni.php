<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimoni extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'title', 'testimoni', 'image', 'published', 'status', 'created_by', 'updated_by', 'deleted_by'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $user = Auth::user();
            if ($user != null) {
                $model->created_by = $user->id;
            }
        });
        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->id;
            $model->updated_at = Carbon::now();
        });
        static::deleting(function ($model) {
            if (!$model->isForceDeleting()) {
                $user = Auth::user();
                $model->deleted_by = $user->id;
                $model->save();
            }
        });
    }
    public function isForceDeleting()
    {
        return $this->forceDeleting;
    }

    public function getCreatedAtAttribute($value)
    {
        return tglIndoAngkaJam($value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return tglIndoAngkaJam($value);
    }

    /**
     * Get all of the MenuTestimoni for the Testimoni
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function MenuTestimoni(): HasMany
    {
        return $this->hasMany(MenuTestimoni::class);
    }
}
