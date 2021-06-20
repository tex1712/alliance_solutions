<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'data' => [
                'id' => (string)$this->id,
                'type' => 'expenses',
                'attributes' => [
                    'name' => $this->name,
                    'total' => (string)$this->total,
                    'date' => $this->date,
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at
                ]
            ]
        ];
    }
}
