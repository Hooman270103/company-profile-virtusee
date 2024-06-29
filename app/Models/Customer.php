<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'gender',
        'email',
        'phone',
        'address',
        'title',
        'know_where',
        'company_name',
        'province_id',
        'regency_id',
        'district_id',
        'village_id',
        'company_address',
        'company_phone',
        'company_email',
        'description',
        'schedule',
        'marketing_contact',
    ];

    /**
     * Get the Province that owns the Customers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Get the Regency that owns the Customers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Regency(): BelongsTo
    {
        return $this->belongsTo(Regency::class);
    }

    /**
     * Get the District that owns the Customers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function District(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Get the Village that owns the Customers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Village(): BelongsTo
    {
        return $this->belongsTo(Village::class);
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
