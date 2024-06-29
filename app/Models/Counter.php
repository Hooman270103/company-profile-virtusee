<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Counter extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title', 'data_counter', 'created_by', 'updated_by', 'deleted_by', 'published', 'status'
    ];


    public static function boot()
    {
       parent::boot();
       static::creating(function($model)
       {
           $user = Auth::user();
           if($user != null){
               $model->created_by = $user->id;
           }
       });
       static::updating(function($model)
       {
           $user = Auth::user();
           $model->updated_by = $user->id; 
           $model->updated_at = Carbon::now();
       });

       static::deleting(function($model) {
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
    
    /**
     * Get all of the MenuCounter for the Counter
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function MenuCounter(): HasMany
    {
        return $this->hasMany(MenuCounter::class);
    }


    public function getCreatedAtAttribute($value)
    {
        return tglIndoAngkaJam($value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return tglIndoAngkaJam($value);
    }
   

    public function getDataCounterAttribute($value)  {
        return json_decode($value);
        
    }
}
