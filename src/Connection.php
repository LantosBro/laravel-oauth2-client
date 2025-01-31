<?php

namespace LantosBro\OAuth2;

use LantosBro\OAuth2\Contracts\Connection as ConnectionContract;
use LantosBro\OAuth2\Support\Providers\GenericProvider;
use LantosBro\OAuth2\Traits\ForwardsCalls;

class Connection implements ConnectionContract
{
    use ForwardsCalls;

    const PKCE_METHOD_S256 = 'S256';
    const PKCE_METHOD_PLAIN = 'plain';

    protected $provider;
    protected $options;

    /**
     * Return if the OAuth2 implementation is authenticated.
     *
     * @param  string  $integration
     * @return bool
     *
     */
    public function authenticated($integration)
    {
        $config = config($integration);
        $token = new $config['tokenModel']($integration);

        return $token->authenticated();
    }

    /**
     * Set connection options.
     *
     * @param  array  $options
     * @return self
     *
     */
    public function withOptions($options)
    {
        $this->options = $options;
        $this->provider = new GenericProvider($options);

        return $this;
    }

    /**
     * Handle dynamic method calls into the model. Forward calls to the provider
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->forwardCallTo($this->provider, $method, $parameters);
    }
}
