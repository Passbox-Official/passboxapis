<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function __construct($resource, public string $message = '')
    {
        parent::__construct($resource);
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
            'message' => $this->message,
            'data' => [
                'email' => $this->email,
                'name' => sprintf('%s %s %s',
                    trim($this->first_name),
                    trim($this->middle_name),
                    trim($this->last_name)
                ),
                'avatar' => $this->avatar,
                'gender' => $this->gender,
            ],
        ];
    }
}
