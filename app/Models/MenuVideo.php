<?php

namespace App\Models;

use App\Models\Menu;
use App\Models\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuVideo extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'menu_id', 'video_id'
    ];

    /**
     * Get the Menu that owns the MenuVideo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
    /**
     * Get the Video that owns the MenuVideo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }
}
