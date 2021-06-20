<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'data' => [
                'id' => (string)$this->id,
                'type' => 'orders',
                'attributes' => [
                    'name' => $this->name,
                    'total' => (string)$this->total,
                    'client_id' => (string)$this->client_id,
                    'date' => $this->date,
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at
                ]
            ]
        ];
    }
}
