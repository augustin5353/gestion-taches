<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class RefresDbCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refres-db-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh db to set the taches beginned_at column to now() date if the begin_at is the day now()';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $taches = Task::all();
        foreach($taches as $tache){

            $begin = Carbon::parse($tache->begin_at);
            $finish = Carbon::parse($tache->finish_at);

            if($begin->isSameDay(now())){
                if($tache->beginned_at == null)
                $tache->beginned_at = now();
                $tache->save();
            }

            if($finish->isSameDay(now())){
                if($tache->finished_at == null)
                $tache->finished_at = now();
                $tache->save();
            }
            
            
        }
    }
}
