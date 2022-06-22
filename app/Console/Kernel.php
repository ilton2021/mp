<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\MPsNCorrigidas;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\MPsNCorrigidas::class,
    ];

    protected function schedule(Schedule $schedule)
    {
		$schedule->command('mps:cron')->dailyAt('11:18');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
