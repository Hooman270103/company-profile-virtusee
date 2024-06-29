<?php

namespace App\Models;

use App\Models\GalleryCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuGallery extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'menu_id', 'galery_category_id'
    ];

    public function galleryCategory()
    {
        return $this->belongsTo(GalleryCategory::class, 'galery_category_id');
    }

    /**
     * Get the Menu that owns the MenuFaq
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }


}
