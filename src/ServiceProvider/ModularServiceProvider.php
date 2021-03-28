<?php

namespace devopsteam\modular\ServiceProvider;

use devopsteam\modular\InitCommand;
use Illuminate\Support\ServiceProvider as SupportServiceProvider;

class ModularServiceProvider extends SupportServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InitCommand::class,
            ]);
        }
    }
}
