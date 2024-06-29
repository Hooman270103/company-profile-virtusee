<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuSection extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['menu_id', 'section_id'];


    /**
     * Get the Menu that owns the MenuSection
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
}
