<?php

namespace NomanSheikh\LaravelOneTimeOperations\Providers;

use Illuminate\Support\ServiceProvider;
use NomanSheikh\LaravelOneTimeOperations\Commands\OneTimeOperationShowCommand;
use NomanSheikh\LaravelOneTimeOperations\Commands\OneTimeOperationsMakeCommand;
use NomanSheikh\LaravelOneTimeOperations\Commands\OneTimeOperationsProcessCommand;

class OneTimeOperationsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom([__DIR__.'/../../database/migrations']);

        $this->publishes([
            __DIR__.'/../../config/one-time-operations.php' => config_path('one-time-operations.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands(OneTimeOperationsMakeCommand::class);
            $this->commands(OneTimeOperationsProcessCommand::class);
            $this->commands(OneTimeOperationShowCommand::class);
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/one-time-operations.php', 'one-time-operations'
        );
    }
}
