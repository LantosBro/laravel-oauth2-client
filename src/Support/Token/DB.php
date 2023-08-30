<?php

namespace LantosBro\OAuth2\Support\Token;

use LantosBro\OAuth2\Integration;
use LantosBro\OAuth2\Support\Token\Base as TokenBase;

class DB extends TokenBase
{
    protected $model;
    protected $additional;

    public function __construct($integration)
    {
        $this->model = Integration::where('name', $integration)->firstOrNew();
        $this->setFromModel($this->model);

        return $this;
    }

    public function setFromModel($model)
    {
        $this->setAccessToken($model->accessToken);
        $this->setPkceCode($model->pkceCode);
        $this->setRefreshToken($model->refreshToken);
        $this->setExpires($model->expires);
        $this->setAdditional($model->additional);

        return $this;
    }

    public function setAdditional(array|null $additional)
    {
        $this->additional = $additional;

        return $this;
    }

    public function additional()
    {
        return $this->additional;
    }

    public function save()
    {
        $this->model->accessToken = $this->accessToken();
        $this->model->refreshToken = $this->refreshToken();
        $this->model->pkceCode = $this->pkceCode();
        $this->model->expires = $this->expires();
        $this->model->additional = $this->additional();
        $this->model->save();

        return $this;
    }
}
