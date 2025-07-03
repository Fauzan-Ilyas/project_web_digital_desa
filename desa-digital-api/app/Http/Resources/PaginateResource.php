<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

// class PaginateResource extends JsonResource
class PaginateResource extends ResourceCollection
{
    /**
     * create a new resource instance.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($resource, public $resourceClass = null)
    {
        parent::__construct($resource); 
    }

    // public function collect($resource)
    // {
    //     return $this->resourceClass::collection($resource);
    // }

    public function collect($resource)
    {
        if (!$this->resourceClass) {
            throw new \InvalidArgumentException('Resource class is not defined in PaginateResource.');
        }

        return $this->resourceClass::collection($resource);
    }


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|illuminate\Contracts\Support\Arrayable|jsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collect($this->resource),
            'meta' => [
                'current_page' => $this->currentPage(),
                'from' => $this->firstItem(),
                'last_page' => $this->lastPage(),
                'path' => $this->path(),
                'per_page' => $this->perPage(),
                'to' => $this->lastItem(),
                'total' => $this->total(),
            ],
        ];
    }
}