<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UserResource extends JsonResource
{
    public function __construct($resource, public string $message = '', public string $token = '', public string $login_at = '')
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
                'logged_in_at' => $this->when(! empty($this->login_at), function () {
                    $date = Carbon::createFromDate($this->login_at);
                    return $date->format('Y M, d - h:i a');
                }),
                'token' => $this->when(! empty($this->token), $this->token),
            ],
        ];
    }
}
