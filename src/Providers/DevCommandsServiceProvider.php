<?php

namespace Linchaker\DevCommands\Providers;

use Illuminate\Support\ServiceProvider;
use Linchaker\DevCommands\Console\Commands\CheckDBCommand;
use Linchaker\DevCommands\Console\Commands\CheckRedisCommand;
use Linchaker\DevCommands\Console\Commands\GeneratePhpDocCommand;

class DevCommandsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CheckRedisCommand::class,
                CheckDBCommand::class,
                GeneratePhpDocCommand::class,
            ]);
        }
    }
}
