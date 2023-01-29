<?php

namespace Linchaker\DevCommands\Test;

use Orchestra\Testbench\TestCase;

class FeatureTestCase extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }


    protected function getPackageProviders($app)
    {
        return [
            'Linchaker\DevCommands\Providers\DevCommandsServiceProvider',
        ];
    }
}
