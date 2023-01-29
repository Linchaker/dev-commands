<?php

declare(strict_types=1);

namespace Linchaker\DevCommands\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CheckDBCommand extends Command
{
    protected $signature = 'check:db {connection=mysql}';

    public function handle()
    {
        $this->isDbReady($this->argument('connection'))
            ? $this->info('Database enabled')
            : $this->info('Database disabled');
        return 0;
    }

    protected function isDbReady($connection = null): bool
    {
        try {
            DB::connection($connection)->getPdo();
        } catch (Exception $e) {
            $this->error($e->getMessage());
            return false;
        }
        return true;
    }
}
