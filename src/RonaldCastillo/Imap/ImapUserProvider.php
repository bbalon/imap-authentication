<?php

namespace RonaldCastillo\Imap;

use Illuminate\Session\Store;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserProviderInterface;

class ImapUserProvider implements UserProviderInterface
{

    /**
     * @protected
     * @var string
     */
    protected $model;

    /**
     * @protected
     * @var Store
     */
    protected $session;

    /**
     * Create a new imap user provider.
     *
     * @param string $model
     * @param array $params
     */
    public function __construct($model, array $params, Store $session)
    {
        $this->model = $model;
        $this->params = $params;
        $this->session = $session;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveById($identifier)
    {
        return $this->session->get('user.current');
    }

    /**
     * Retrieve a user by by their unique identifier and "remember me" token.
     *
     * @param  mixed  $identifier
     * @param  string  $token
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveByToken($identifier, $token) { }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Auth\UserInterface  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(UserInterface $user, $token) { }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        $username = $credentials[$this->params['identifier']];
        $imap = @\imap_open($this->params['datasource'], $username, $credentials['password']);

        if(false !== $imap) {
            $credentials['id'] = $username;

            $user = new $this->model($credentials);

            $this->session->set('user.current', $user);

            return $user;
        }
        return null;
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Auth\UserInterface  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(UserInterface $user, array $credentials)
    {
        return ($user->getAuthPassword() === $credentials['password']);
    }
}
