<?php

namespace App\Http\Resources;

use App\Models\Notebook;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;


/** 
 * @property Notebook $resource
 * @mixin Notebook
 */
class NotebookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return Arr::only(
            $this->resource->getAttributes(),
            [
                'id',
                'name',
                'company',
                'phone',
                'email',
                'birthday',
                'image'
            ]
        );
    }
}
