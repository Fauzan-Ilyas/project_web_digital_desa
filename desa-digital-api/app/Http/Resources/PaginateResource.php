<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaginateResource extends JsonResource
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

    public function collect($resource)
    {
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