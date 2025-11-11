<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait DynamicResource
{
    /**
     * Generate a *0-9* code of a given length
     * @throws Exception
     */
    public function getDynamicResources(): array
    {
        $resource = [];
        foreach ($this->getRelations() as $relationName => $relation) {
            $relation = $this->{$relationName};

            $relatedModel = $relation instanceof Collection ? $relation->first() : $relation;
            $resourceClass = 'App\\Http\\Resources\\' . class_basename($relatedModel) . 'Resource';

            if (class_exists($resourceClass)) {
                if ($relation instanceof Collection) {
                    $resource[Str::camel($relationName)] = $resourceClass::collection($relation);
                } else {
                    $resource[Str::camel($relationName)] = new $resourceClass($relation);
                }
            } else {
                $resource[Str::camel($relationName)] = $relation;
            }
        }
        return $resource;
    }
}
