<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\MenuFaq;
use App\Models\MenuPost;
use App\Models\MenuVideo;
use App\Models\MenuCounter;
use App\Models\MenuGallery;
use App\Models\MenuSection;
use App\Models\MenuTestimoni;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'status', 'slug', 'created_by', 'updated_by', 'parent_id', 'link_url', 'type', 'position'
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
    }

    /**
     * Get all of the MenuPost for the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function MenuPost(): HasMany
    {
        return $this->hasMany(MenuPost::class, 'menu_id');
    }

    /**
     * Get all of the MenuEvent for the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function MenuEvent(): HasMany
    {
        return $this->hasMany(MenuPost::class, 'menu_id')->whereNotNull('event_id');
    }

    /**
     * Get all of the MenuEvent for the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function MenuArticles(): HasMany
    {
        return $this->hasMany(MenuPost::class, 'menu_id')->whereNotNull('post_id');
    }

    /**
     * Get all of the MenuEvent for the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function MenuSectionPost(): HasMany
    {
        return $this->hasMany(MenuPost::class, 'menu_id')->whereNotNull('post_id');
    }

    /**
     * Get all of the MenuEvent for the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function MenuNews(): HasMany
    {
        return $this->hasMany(MenuPost::class, 'menu_id')->whereNotNull('post_id');
    }

    /**
     * Get all of the MenuEvent for the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function MenuAnnouncements(): HasMany
    {
        return $this->hasMany(MenuPost::class, 'menu_id')->whereNotNull('post_id');
    }

    /**
     * Get all of the MenuEvent for the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function MenuGalleryPhoto(): HasMany
    {
        return $this->hasMany(MenuGallery::class, 'menu_id');
    }

    /**
     * Get all of the MenuEvent for the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function MenuGalleryVideos(): HasMany
    {
        return $this->hasMany(MenuVideo::class, 'menu_id');
    }

    /**
     * Get all of the MenuSection for the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function MenuSection(): HasMany
    {
        return $this->hasMany(MenuSection::class, 'menu_id');
    }

    /**
     * Get all of the MenuFaq for the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function MenuFaq(): HasMany
    {
        return $this->hasMany(MenuFaq::class, 'menu_id');
    }


    /**
     * Get all of the MenuCounter for the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function MenuCounter(): HasMany
    {
        return $this->hasMany(MenuCounter::class, 'menu_id');
    }

    /**
     * Get all of the MenuTestimoni for the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function MenuTestimoni(): HasMany
    {
        return $this->hasMany(MenuTestimoni::class, 'menu_id');
    }

    /**
     * Get all of the MenuVideo for the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function MenuVideo(): HasMany
    {
        return $this->hasMany(MenuVideo::class, 'menu_id');
    }

    /**
     * Get the Parent that owns the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return tglIndoAngkaJam($value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return tglIndoAngkaJam($value);
    }
}
