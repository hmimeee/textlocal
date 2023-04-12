<?php

namespace Hmimeee\TextLocal;

use Illuminate\Support\ServiceProvider;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use Hmimeee\TextLocal\Channels\TextLocalChannel;

class TextLocalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('textlocal.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'textlocal');

        $this->app->bind(TextLocalChannel::class, function ($app) {
            return new TextLocalChannel(
                $app['config']['textlocal']['api_key'],
                $app['config']['textlocal']['sender']
            );
        });

        Notification::resolved(function (ChannelManager $service) {
            $service->extend('sms', function ($app) {
                return $app->make(TextLocalChannel::class);
            });
        });
    }
}
