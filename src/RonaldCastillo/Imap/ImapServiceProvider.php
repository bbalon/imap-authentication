<?php

namespace RonaldCastillo\Imap;

use Illuminate\Support\ServiceProvider;

class ImapServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('ronaldcastillo/imap-authentication');

        $this->app['auth']->extend('imap', function()
        {
            return new ImapUserProvider(
                $this->app['config']->get('auth.model'),
                $this->app['config']->get('imap')
            );
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }
}