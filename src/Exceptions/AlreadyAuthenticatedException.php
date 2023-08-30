<?php

namespace LantosBro\OAuth2\Exceptions;

class AlreadyAuthenticatedException extends Base
{
    public function __construct($name)
    {
        parent::__construct($name.' already authorised.');
    }
}
