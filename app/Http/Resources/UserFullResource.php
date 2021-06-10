<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserFullResource extends JsonResource
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

           'user_id'=>$this->id,
           'first_name'=>$this->first_name,
           'last_name'=>$this->last_name,
            'email_verified'=>$this->email_verified,
           'email'=>$this->email,
            'mobile'=>$this->mobile,
        'mobile_verified'=>$this->mobile_verified,
            'shipping_address'=> new AdressResource($this->shippingAddress	),
            'billing_address'=> new AdressResource($this->billingAddress	),
            'member_since'=>$this->created_at->format('d->l \\of m->F  Y'),

        ];
    }
}
