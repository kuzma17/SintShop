<?php

namespace App\Http\Resources;

use App\Models\ValueAttribute;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'name_ru' => $this->name,
            'type' => $this->type,
            'format' => $this->format,
        ];

        if ($this->type_id == 1 || $this->type_id == 4) {
            $data['values'] = ValueAttributeResource::collection($this->values);
        }

        return $data;
    }
}
