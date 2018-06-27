<?php

namespace SeshSource;

use SeshSource\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use Uuids;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'video_embed',
        'start_date',
        'end_date',
        'latitude',
        'longitude',
        'street_address',
        'city',
        'state',
        'postal_code',
        'country',
        'website',
        'email',
        'organizer_id',
        'event_logo',
        'featured_img',
        'terms'
    ];
}
