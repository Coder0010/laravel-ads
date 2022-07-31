<?php

namespace MKamelMasoud\Ads\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;
use MKamelMasoud\Ads\Console\Commands\ReminderCommand;

class PackageServiceProvider extends ServiceProvider
{
    public string $packagePath = __DIR__ . "/../..";

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('whereLike', function (string $attribute, string $searchTerm) {
            return $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
        });
        $this->loadRoutesFrom("{$this->packagePath}/routes/api.php");
        $this->loadMigrationsFrom("{$this->packagePath}/database/migrations");
        $this->loadViewsFrom("{$this->packagePath}/resources", "ads");

        if ($this->app->runningInConsole()) {
            $this->commands([
                ReminderCommand::class,
            ]);
        }
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('reminder daily')->everyMinute();
        });
    }
}
