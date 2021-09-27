<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CategoryController extends Controller
{

    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    public function store(CategoryRequest $request)
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

    public function show($id)
    {
        $category = Category::findOrFail($id);

        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, $id)
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

    public function destroy($id)
    {
        $category = Category::findOrfail($id);
        $category->delete();

        return response()->json(null, 204);
    }
}
