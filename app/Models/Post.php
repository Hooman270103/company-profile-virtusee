<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\MenuPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'image', 'tags', 'description', 'type', 'published', 'status', 'created_by', 'updated_by', 'deleted_by'
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

    public function getTagsAttribute($value)
    {
        return json_decode($value);
    }

    public function menu_post()
    {
        return $this->hasMany(MenuPost::class, 'post_id');
    }
    /**
     * Get the CreatedBy that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function CreatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
