<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CategoryController extends Controller
{
    /**
     * List of category
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * Create new category
     *
     * @param CategoryRequest $request
     * @return CategoryResource
     * @throws \Exception
     */
    public function store(CategoryRequest $request): CategoryResource
    {
        try {
            $category = new Category();
            $category->fill($request->validated())->save();

            if ((array) $bloodsId = $request->get('bloods_id')) {
                foreach ($bloodsId as $bloodId) {
                    $category->categories()->attach($bloodId);
                }

                $category->save();
            }

            return new CategoryResource($category);

        } catch (\Exception $exception) {
            throw new \Exception("Invalid data - {$exception->getMessage()}", 400);
        }
    }


    /**
     * Get category
     *
     * @param int $id Category id
     *
     * @return CategoryResource
     */
    public function show(int $id): CategoryResource
    {
        $category = Category::findOrFail($id);

        return new CategoryResource($category);
    }

    /**
     * Update category
     *
     * @param CategoryRequest $request
     * @param int $id Category id
     *
     * @return CategoryResource
     */
    public function update(CategoryRequest $request, int $id): CategoryResource
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                throw new HttpException(400, "Category not found");
            }

            $category->fill($request->validated())->save();

            foreach ((array)$request->get('bloods_id') as $bloodId) {
                $category->categories()->attach($bloodId);
            }

            $category->save();

            return new CategoryResource($category);

        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }
    }

    /**
     * Delete category
     *
     * @param int $id Category id
     *
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $category = Category::findOrfail($id);
        $category->delete();

        return response()->json(null, 204);
    }
}
