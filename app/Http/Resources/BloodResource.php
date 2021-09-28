<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BloodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $categories = [];

        foreach ($this->categories as $category) {
            $categories[] = [
                'id' => $category->id,
                'title' => $category->title
            ];
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'code' => $this->code,
            'codeICD' => $this->codeICD,
            'categories' => $categories
        ];
    }
}
