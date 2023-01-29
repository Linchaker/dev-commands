<?php

declare(strict_types=1);

namespace Linchaker\DevCommands\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class CheckRedisCommand extends Command
{
    protected $signature = 'check:redis {connection=default}';

    protected $description = 'Checking if redis is enabled';

    public function handle()
    {
        self::isRedisReady($this->argument('connection'))
            ? $this->info('Redis enabled')
            : $this->info('Redis disabled');
        return 0;
    }

    public static function isRedisReady($connection = null): bool
    {
        try {
            $redis = Redis::connection($connection);
            $redis->getName();
            $redis->disconnect();
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}
