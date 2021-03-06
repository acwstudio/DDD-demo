<?php

namespace App\Console;

use App\Console\Admins\Commands\AdminBanCommand;
use App\Console\Admins\Commands\AdminRegisterCommand;
use App\Console\Admins\Commands\AdminResetPasswordCommand;
use App\Console\Customers\Commands\CustomerBanCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel
 * @package App\Console
 */
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        AdminRegisterCommand::class,
        AdminResetPasswordCommand::class,
        AdminBanCommand::class,
        CustomerBanCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
