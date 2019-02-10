<?php

namespace Sanjeev\MySqlBackup;

use Illuminate\Support\ServiceProvider;
use Sanjeev\MySqlBackup\Console\MySqlBackup;

class MySqlBackupServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind('command.make:mysql:backup', MySqlBackup::class);

        $this->commands([
            'command.make:mysql:backup'
        ]);
    }

}
