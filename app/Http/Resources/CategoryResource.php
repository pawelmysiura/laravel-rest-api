<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $bloods = [];

        foreach ($this->bloods as $blood) {
            $bloods[] = [
                'id' => $blood->id,
                'title' => $blood->title,
                'code' => $blood->code,
                'codeICD' => $blood->codeICD
            ];
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'bloods' => $bloods
        ];
    }
}
