<?php

namespace App\Http\Resources;

use App\Traits\DynamicResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'name'  => $this->name,
        ];

        return [...$resource, ...$this->getDynamicResources()];
    }
}
