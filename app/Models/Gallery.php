<?php

namespace App\Models;

use App\Models\GalleryCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'image', 'position', 'category_id'
    ];

    public function galleryCategory()
    {
        return $this->belongsTo(GalleryCategory::class, 'category_id');
    }
}
