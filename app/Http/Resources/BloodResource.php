<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BloodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
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
