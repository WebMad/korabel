<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'surname' => (isset($this->surname)) ? $this->surname : '',
            'patronymic' => (isset($this->patronymic)) ? $this->patronymic : '',
            'email' => $this->email,
            'phone' => (isset($this->phone)) ? $this->phone : '',
            'active' => $this->active,
        ];
    }
}
