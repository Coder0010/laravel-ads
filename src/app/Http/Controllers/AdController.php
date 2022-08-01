<?php

namespace MKamelMasoud\Ads\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pipeline\Pipeline;
use MKamelMasoud\Ads\Http\Filters\CategoryFilter;
use MKamelMasoud\Ads\Http\Filters\NameFilter;
use MKamelMasoud\Ads\Http\Filters\TagFilter;
use MKamelMasoud\Ads\Http\Resources\AdResource;
use MKamelMasoud\Ads\Models\Ad;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(): AnonymousResourceCollection
    {

        $data = app(Pipeline::class)
            ->send(Ad::query())
            ->through([
                NameFilter::class,
                CategoryFilter::class,
                TagFilter::class,
            ])
            ->thenReturn()
            ->with(['category', 'tags', 'advertiser'])
            ->latest('id')
            ->get();

        return AdResource::collection($data);

        $data = Ad::query();

        $adName = request('name');
        if ($adName) {
            $data->where('name', $adName);
        }

        $category = request('category');
        if ($category) {
            $data->where('category_id', $category);
        }

        $tag = request('tag');
        if ($tag) {
            $data->whereHas('tags', function ($q) use ($tag) {
                $q->whereIn('id', [$tag]);
            });
        }
        $data = $data->with(['category', 'tags', 'advertiser'])->latest('id')->get();
        return AdResource::collection($data);
    }

    public function show(int $ad)
    {
        return new AdResource(Ad::findOrFail($ad));
    }

}
