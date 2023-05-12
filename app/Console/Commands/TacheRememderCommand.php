<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\View\Components\Task;
use App\Notifications\TacheRememderNotification;

class TacheRememderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:tache-rememder-notification-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification to a user';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $users = User::all();

        foreach($users as $user)
        {
            $taches = $user->taches()->whereDate('finish_at', '<=', Carbon::now()->addDays(3))->whereNull('finished_at')->get();

            foreach($taches as $tache)
            {
                if($tache->notifiable == true){
                    $user->notify(new TacheRememderNotification($tache, $user));
                }
                
            }
        }
    }
}
