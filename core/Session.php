<?php

namespace app\core;

class Session
{
    protected const FLASH_KEY = 'flash_messages';
    protected const CSRF_TOKEN = 'token';
    protected const CSRF_TOKEN_EXPIRE = 'token-expire';

    public function __construct()
    {
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];

        foreach ($flashMessages as &$flashMessage) {
            $flashMessage['remove'] = true;
        }

        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    public function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }

    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    public function __destruct()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];

        foreach ($flashMessages as $key => &$flashMessage) {
            if ($flashMessage['remove']) {
                unset($flashMessages[$key]);
            }
        }

        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    public function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key)
    {
        return $_SESSION[$key] ?? false;
    }

    public function remove(string $key)
    {
        unset($_SESSION[$key]);
    }

    public function generateToken()
    {
        $token = bin2hex(openssl_random_pseudo_bytes(32));

        self::set(self::CSRF_TOKEN, $token);
        self::set(self::CSRF_TOKEN_EXPIRE, time() + 3600);

        return $token;
    }

    public function validateToken($token)
    {
        $saved = self::get(self::CSRF_TOKEN);
        $savedTime = self::get(self::CSRF_TOKEN_EXPIRE);

        $isExpired = time() <= $savedTime;

        self::remove(self::CSRF_TOKEN);
        self::remove(self::CSRF_TOKEN_EXPIRE);

        return $saved === $token && $isExpired;
    }

}