<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'logo_primary',
        'logo_secondary',
        'favicon',
        'name',
        'tagline',
        'description',
        'no_telp',
        'address',
        'maps_location',
        'email',
        'link_instagram',
        'link_facebook',
        'link_twitter',
        'link_tiktok',
        'link_linkedin',
        'color_primary',
        'color_secondary',
        'mail_mailer',
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_password',
        'mail_encryption',
        'mail_from_addres',
        'mail_from_name'
    ];


    public function getCreatedAtAttribute($value)
    {
        return tglIndoAngkaJam($value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return tglIndoAngkaJam($value);
    }

    public function getColorPrimaryAttribute($value)  {
        return json_decode($value);
    }
    public function getColorSecondaryAttribute($value)  {
        return json_decode($value);
    }
}
