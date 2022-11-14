<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'name'      => $this->name,
            'phone'     => $this->phone,
            'address'       => $this->address,
            'image_link'    => $this->image_link,
            'instagram_link'    => $this->instagram_link,
            'location_link'     => $this->location_link,
        ];
    }
}
