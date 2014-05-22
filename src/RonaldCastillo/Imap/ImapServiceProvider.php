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

        $app = $this->app;

        $this->app['auth']->extend('imap', function() use ($app)
        {
            return new ImapUserProvider(
                $app['config']->get('auth.model'),
                $app['config']->get('imap-authentication::imap')
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
