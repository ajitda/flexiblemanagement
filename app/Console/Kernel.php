<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\DailyReport',
        'App\Console\Commands\BirdReport',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('report:daily')->dailyAt('1:55');
        $schedule->command('report:dailybird')->dailyAt('13:55');
//         $schedule->command('inspire')
//                 ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
