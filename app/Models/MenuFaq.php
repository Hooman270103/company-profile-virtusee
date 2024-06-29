<?php

namespace App\Models;

use App\Models\Faq;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuFaq extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['menu_id', 'faq_id'];

    /**
     * Get the Menu that owns the MenuFaq
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * Get the Faq that owns the MenuFaq
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Faq(): BelongsTo
    {
        return $this->belongsTo(Faq::class);
    }
}
