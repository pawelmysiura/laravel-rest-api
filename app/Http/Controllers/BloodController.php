<?php

namespace App\Http\Controllers;

use App\Http\Requests\BloodRequest;
use App\Http\Resources\BloodResource;
use App\Models\Blood;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BloodController extends Controller
{
    public function index()
    {
        return BloodResource::collection(Blood::all());
    }

    public function show(int $id): BloodResource
    {
        $blood = Blood::findOrFail($id);

        return new BloodResource($blood);
    }

    public function store(BloodRequest $request): BloodResource
    {
        try {
            $blood = new Blood;
            $blood->fill($request->validated())->save();

            if ((array) $categoriesId = $request->get('categories_id')) {
                foreach ($categoriesId as $categoryId) {
                    $blood->categories()->attach($categoryId);
                }

                $blood->save();
            }

            return new BloodResource($blood);

        } catch (\Exception $exception) {
            throw new \Exception("Invalid data - {$exception->getMessage()}", 400);
        }
    }

    public function update(BloodRequest $request, int $id): BloodResource
    {
        try {
            $blood = Blood::find($id);

            if (!$blood) {
                throw new HttpException(400, "Blood not found");
            }

            $blood->fill($request->validated());

            foreach ((array) $request->get('categories_id') as $categoryId) {
                $blood->categories()->attach($categoryId);
            }

            $blood->save();

            return new BloodResource($blood);

        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }
    }

    public function destroy(int $id): JsonResponse
    {
        $book = Blood::findOrfail($id);
        $book->delete();

        return response()->json(null, 204);
    }

}
