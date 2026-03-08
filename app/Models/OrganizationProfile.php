<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationProfile extends Model
{
    protected $fillable = [
        'name',
        'slogan',
        'history',
        'philosophy',
        'vision',
        'mission',
        'registration_link',
        'map_iframe',
        'contact_phone',
        'contact_email',
        'hero_image',
        'footer_description',
        'instagram_url',
        'youtube_url',
        'facebook_url',
    ];
}
