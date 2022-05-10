<?php

namespace App\Services;

use App\Exceptions\UrlAlreadyExistsException;

class Password
{
    public function store(array $request = []): void
    {
        $input = [
            'url' => $request['url'],
            'name' => $request['name'],
            'password' => $request['password'],
        ];
        if (auth()->user()->url_exists($request['url'])) {
            throw new UrlAlreadyExistsException();
        }
        auth()->user()->passwords()->create($input);
    }
}
