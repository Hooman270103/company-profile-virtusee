<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuPost extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'menu_id', 'post_id', 'event_id', 'created_by', 'updated_by', 'deleted_by'
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
     * Get the menu that owns the MenuPost
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
