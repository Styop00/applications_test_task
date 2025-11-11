<?php

namespace App\Http\Resources;

use App\Traits\DynamicResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    use DynamicResource;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function toArray(Request $request): array
    {
        $resource = [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'city_id'     => $this->city_id,
            'status_id'   => $this->status_id,
            'author_id'   => $this->author_id,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];

        return [...$resource, ...$this->getDynamicResources()];
    }
}
