<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PasswordResource extends JsonResource
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
            'message' => 'Password for ' . $this->url,
            'data' => [
                'username' => $this->user_name,
                'password' => $this->password,
            ],
        ];
    }
}
