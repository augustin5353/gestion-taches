<?php

namespace App\Console;

use App\Console\Commands\RefresDbCommand;
use App\Console\Commands\TacheRememderCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected $commands = [
        TacheRememderCommand::class,
        RefresDbCommand::class
    ];
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        $schedule->command('user:tache-rememder-notification-command')->everyMinute();
        $schedule->command('app:refres-db-command')->dailyAt('22');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');

    }

    
}
