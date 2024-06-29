<?php

namespace App\Models;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuTestimoni extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['menu_id', 'testimoni_id'];

    /**
     * Get the Menu that owns the MenuTestimoni
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * Get the user that owns the MenuTestimoni
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    }
}
