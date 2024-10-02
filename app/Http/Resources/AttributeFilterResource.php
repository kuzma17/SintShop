<?php

namespace App\Http\Resources;

use App\Models\ValueAttribute;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeFilterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            //'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
//            'type' => $this->type,
//            'format' => $this->format,
            'values' => ValueAttributeResource::collection($this->values)
        ];
    }
}
