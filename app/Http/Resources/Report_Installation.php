<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Report_Installation extends JsonResource
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
            'category_instansi' => $this->category_instansi,
            'installation_id' => $this->installation_id,
            'start_installation' => $this->start_installation,
            'start_training	' => $this->start_training,
            'complete_training' => $this->complete_training,
            'completed_installation' => $this->completed_installation,
            'condition' => $this->condition,
            'problem' => $this->problem,
            'video' => $this->video,
            'status' => $this->status,
            'anydesk_id' => $this->anydesk_id,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
