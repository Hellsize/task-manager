<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrpjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'title'=> $this->title,
            'tasks'=> TaskResource::collection($this->whenLoaded('tasks')),
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updateed_at,
        ];
    }
}
