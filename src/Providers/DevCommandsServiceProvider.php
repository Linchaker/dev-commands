<?php

namespace Linchaker\DevCommands\Providers;

use Illuminate\Support\ServiceProvider;
use Linchaker\DevCommands\Console\Commands\CheckRedisCommand;

class DevCommandsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CheckRedisCommand::class,
            ]);
        }
    }
}
