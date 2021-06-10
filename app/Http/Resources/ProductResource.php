<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
   'product_id'  => $this->id,
     'product_title' =>$this->title,
            'product_description' =>$this->description,
            'product_price' =>doubleval($this->price ),
            'product_unit' => new UnitResource($this->hasUnit),
            'product_total' =>number_format($this->total , 2),
            'product_discount'=>number_format($this->discount , 2),
            'product_category' => new CategoryResource($this->category),
            'product_tag'=>  TagResource::collection($this->tags),
            'product_image'=>  ImageResource::collection($this->images),
            'product_review'=> ReviewResource::collection($this->reviews),
            'options'=>$this->jsonOptions(),



        ];
    }
}
