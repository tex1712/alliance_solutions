<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
                'type' => 'clients',
                'attributes' => [
                    'name' => $this->name,
                    'employee_id' => (string)$this->employee_id,
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at
                ]
            ],
            'relationships' => [
                'orders' => [
                    'links' => [
                        'self' => route('clients.relationships.orders', ['client' => $this->id]),
                        'related' => route('clients.orders', ['client' => $this->id]),
                    ],
                    'data' => OrderIdentifierResource::collection($this->orders)
                ]
            ]
        ];
    }
}
