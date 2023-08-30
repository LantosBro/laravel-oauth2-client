<?php

namespace LantosBro\OAuth2\Support\Token;

use LantosBro\OAuth2\Contracts\Token;
use LantosBro\OAuth2\Facades\Connection;

abstract class Base implements Token
{
    protected $accessToken;
    protected $refreshToken;
    protected $expires;
    protected $integration;
    protected $pkceCode;

    public function set($options)
    {
        foreach ($options as $key => $item) {
            $this->$key = $item;
        }

        return $this;
    }

    public function setAccessToken($token)
    {
        $this->accessToken = $token;

        return $this;
    }

    public function accessToken()
    {
        return $this->accessToken;
    }

    public function setRefreshToken($token)
    {
        $this->refreshToken = $token;

        return $this;
    }

    public function refreshToken()
    {
        return $this->refreshToken;
    }

    public function setPkceCode($code)
    {
        $this->pkceCode = $code;

        return $this;
    }

    public function pkceCode()
    {
        return $this->pkceCode;
    }

    public function setExpires($timeStamp)
    {
        $this->expires = $timeStamp;

        return $this;
    }

    public function expires()
    {
        return $this->expires;
    }

    public function hasExpired()
    {
        return time() + 60 > $this->expires;
    }

    public function authenticated()
    {
        return $this->accessToken != null;
    }

    public function renewToken()
    {
        if ($this->hasExpired()) {
            $config = config($this->integration);
            $provider = Connection::withOptions($config['oauth2']);
            $accessToken = $provider->getAccessToken('refresh_token', [
                'refresh_token' => $this->refreshToken(),
            ]);
            $this->updateAccessToken($accessToken);
        }

        return $this;
    }

    public function updateAccessToken($accessToken)
    {
        $this->set([
            'accessToken' => $accessToken->getToken(),
            'refreshToken' => $accessToken->getRefreshToken(),
            'pkceCode' => $accessToken->getPkceCode(),
            'expires' => $accessToken->getExpires(),
        ])->save();

        return $this;
    }
}
