<?php

namespace App\Http\Controllers;

use App\Http\Requests\BloodRequest;
use App\Http\Resources\BloodResource;
use App\Models\Blood;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BloodController extends Controller
{
    /**
     * List of blood
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return BloodResource::collection(Blood::all());
    }

    /**
     * Get resource of blood
     *
     * @param int $id Blood id
     *
     * @return BloodResource
     */
    public function show(int $id): BloodResource
    {
        $blood = Blood::findOrFail($id);

        return new BloodResource($blood);
    }

    /**
     * Create new blood
     *
     * @param BloodRequest $request
     * @return BloodResource
     * @throws \Exception
     */
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

    /**
     * Update blood resource
     *
     * @param BloodRequest $request
     * @param int $id Blood id
     *
     * @return BloodResource
     */
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

    /**
     * Delete blood resource
     *
     * @param int $id Blood id
     *
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $book = Blood::findOrfail($id);
        $book->delete();

        return response()->json(null, 204);
    }

}
