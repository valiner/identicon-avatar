<?php

namespace Flex\IdenticonAvatar;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Identicon::class, function(){
            return new Identicon();
        });

        $this->app->alias(Identicon::class, 'identicon');
    }

    public function provides()
    {
        return [Identicon::class, 'identicon'];
    }
}