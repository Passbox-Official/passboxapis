<?php

use App\Models\SystemConfig;
use App\Exceptions\NotFoundException;

if (! function_exists('system_config')) {
    /**
     * Reading configs from system config table
     *
     * @throws NotFoundException
     * @returns string
     */
    function system_config(string $name = '')
    {
        $output = SystemConfig::where('name', $name)->first('value');
        if (! $output) {
            throw new NotFoundException('Sign up system token not found.');
        }
        return $output->value;
    }
}

if (! function_exists('bearer_token')) {
    /**
     * Reading configs from system config table
     *
     * @throws NotFoundException
     * @returns string
     */
    function bearer_token(): string
    {
        $output = SystemConfig::where('name', SystemConfig::BEARER_TOKEN_NAME)->first('value');
        if (! $output) {
            throw new NotFoundException('Bearer token not found.');
        }
        return $output->value;
    }
}

if (! function_exists('valid_bearer_key')) {
    /**
     * Checking for signup key in system config
     *
     * @param string
     * @return bool
     * @throws NotFoundException
     */
    function valid_bearer_key(string $user_key): bool
    {
        return $user_key === bearer_token();
    }
}

if (! function_exists('valid_master_password')) {
    /**
     * Checking for master password in system config
     *
     * @param string
     * @return bool
     * @throws NotFoundException
     */
    function valid_master_password(string $user_password): bool
    {
        return $user_password === system_config(SystemConfig::SUDO_PASSWORD);
    }
}
