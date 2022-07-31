<?php

namespace MKamelMasoud\Ads\Models;

use MKamelMasoud\Ads\Models\Ad;
use MKamelMasoud\Ads\Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Entity
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
    protected static function newFactory(): \Illuminate\Database\Eloquent\Factories\Factory
    {
        return CategoryFactory::new();
    }
}
