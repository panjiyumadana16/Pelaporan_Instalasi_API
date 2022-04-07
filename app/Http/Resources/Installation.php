<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Installation extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'number_of_technicians' => $this->number_of_technicians,
            'category_instansi' => $this->category_instansi,
            'technician_id' => $this->technician_id,
            'name' => $this->name,
            'date_instalation' => $this->date_instalation,
            'pic_name' => $this->pic_name,
            'pic_phone' => $this->pic_phone,
            'status' => $this->status,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
