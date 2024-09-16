<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class destination extends Model
{
    use HasFactory;

    protected $table = "destinations";

    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'slug',
        'location',
        'description',
        'image_url',

    ];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => url('/storage/destinations_image/' . $image),
        );
    }
}
