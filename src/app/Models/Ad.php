<?php

namespace MKamelMasoud\Ads\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;
use MKamelMasoud\Ads\Database\Factories\AdFactory;
use Spatie\Tags\HasTags;

class Ad extends Entity
{
    use HasTags;

    const FREE = 'free';
    const PAID = 'paid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'name',
        'description',
        'category_id',
        'user_id',
        'start_date',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory(): \Illuminate\Database\Eloquent\Factories\Factory
    {
        return AdFactory::new();
    }

    public function scopeSearchByName(Builder $builder, $value)
    {
        if ($value) {
            $builder->where('name', 'LIKE', "%{$value}%");
//            $builder->whereHas('types', function ($query) use ($value) {
//                $query->whereIn('name', [$value]);
//            });
        }
    }

    /**
     * advertiser Relationship.
     *
     * @return belongsTo
     */
    public function advertiser(): BelongsTo
    {
        // i need to add the foreign key name cause the relation name is not like model name
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * category Relationship.
     *
     * @return belongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function related_ads()
    {
        $tags_id = $this->tags()->pluck('tag_id');
        $category_id = $this->category_id;
        $dataByCategory = Ad::whereNotIn('id', [$this->id])->whereCategoryId($category_id)->get();
        $dataByTagsid = Ad::whereNotIn('id', [$this->id])->whereRelation('tags', 'tag_id', '=', $tags_id)->get();

        return collect(
            $dataByCategory,
            $dataByTagsid
        );
    }
}
