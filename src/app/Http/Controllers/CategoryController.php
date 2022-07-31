<?php

namespace MKamelMasoud\Ads\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use MKamelMasoud\Ads\Http\Requests\CategoryRequest;
use MKamelMasoud\Ads\Http\Resources\SimpleResource;
use MKamelMasoud\Ads\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(): AnonymousResourceCollection
    {
        return SimpleResource::collection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return SimpleResource|JsonResponse
     */
    public function store(CategoryRequest $request): SimpleResource|JsonResponse
    {
        DB::beginTransaction();
        try {
            $entity = Category::create($request->all());
            if ($entity) {
                $message = "record {$entity->name} created successfully";
            } else {
                $message = "record not created";
            }
            DB::commit();
            return (new SimpleResource($entity))->additional([
                "message" => $message
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return new JsonResponse([
                "message" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param int $id
     * @return SimpleResource|JsonResponse
     */
    public function update(CategoryRequest $request, int $id): SimpleResource|JsonResponse
    {
        DB::beginTransaction();
        try {
            $entity = Category::find($id);
            if ($entity) {
                $entity->update($request->validated());
                $message = "record {$entity->name} updated successfully";
            } else {
                $message = "record not updated";
            }
            DB::commit();
            return (new SimpleResource($entity))->additional([
                "message" => $message
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return new JsonResponse([
                "message" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return SimpleResource|JsonResponse
     */
    public function destroy(int $id): SimpleResource|JsonResponse
    {
        DB::beginTransaction();
        try {
            $entity = Category::find($id);
            if ($entity) {
                $entity->delete();
                $message = "record {$entity->name} deleted successfully";
            } else {
                $message = "record not found";
            }
            DB::commit();
            return new JsonResponse([
                "message" => $message
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return new JsonResponse([
                "message" => $e->getMessage(),
            ], 500);
        }
    }

}
