<?php

namespace MKamelMasoud\Ads\Models;

use MKamelMasoud\Ads\Models\Ad;
use Spatie\Tags\Tag as SpatieTag;
use MKamelMasoud\Ads\Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends SpatieTag
{

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return TagFactory::new();
    }
}
