<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
                'type' => 'employees',
                'attributes' => [
                    'name' => $this->name,
                    'email' => $this->email,
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at
                ]
            ],
            'relationships' => [
                'clients' => [
                    'links' => [
                        'self' => route('employees.relationships.clients', ['employee' => $this->id]),
                        'related' => route('employees.clients', ['employee' => $this->id]),
                    ],
                    'data' => ClientIdentifierResource::collection($this->clients)
                ]
            ]
        ];
    }
}
