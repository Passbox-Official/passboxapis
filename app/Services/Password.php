<?php

namespace App\Services;

use App\Exceptions\UrlAlreadyExistsException;
use App\Exceptions\NotFoundException;
use App\Models\Password as PasswordModel;

class Password
{
    public function store(array $request = []): void
    {
        $input = [
            'url' => $request['url'],
            'name' => $request['name'],
            'password' => $request['password'],
            'username' => $request['username'],
        ];
        if (auth()->user()->url_exists($request['url'])) {
            throw new UrlAlreadyExistsException();
        }
        auth()->user()->passwords()->create($input);
    }

    public function index()
    {
        return auth()->user()->passwords;
    }

    public function destroy($id): void
    {
        $password = PasswordModel::where('user_id', auth()->user()->id)
            ->where('id', $id)
            ->first();
        if (! $password) {
            throw new NotFoundException('Invalid id');
        }
        $password->delete();
    }

    public function find(string $url = '')
    {
        $result = PasswordModel::where('url', $url)
            ->where('user_id', auth()->user()->id)
            ->first();
        if (! $result) {
            throw new NotFoundException('Invalid url');
        }
        $result->update(['last_used' => now()]);

        // Added data to password history table
        auth()->user()->password_access_history()->create([
            'password_id' => $result->id,
            'created_at' => now(),
        ]);
        return $result;
    }
}
