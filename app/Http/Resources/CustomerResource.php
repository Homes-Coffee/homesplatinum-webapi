<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public $customer;

    public function __construct($customer)
    {
        $this->customer = $customer;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'uuid'  => $this->customer->uuid,
            'name'  => $this->customer->name,
            'email' => $this->customer->email,
            'photo' => $this->customer->image_link,
            'is_active'         => $this->customer->is_active,
            'phone_verified_at' => $this->customer->phone_verified_at
        ];
    }
}
