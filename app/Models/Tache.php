<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @mixin IdeHelperTache
 */
class Tache extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'begin_at',
        'finish_at',
        'beginned_at',
        'finished_at',
        'notifiable',
    ];

    //pour renvoyer les champs date sous forme de date carbon

    /* protected $dates = ['begin_at', 'finish_at', 'beginned_at', 'beginned_at']; */

    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }

    public function getDate(string $date){
        
        $date = Carbon::parse($date);   

        return $date->translatedFormat('d F Y H:i');
    }
}

/* documentation carbon  https://www.gekkode.com/developpement/comment-gerer-datetime-avec-carbon-dans-laravel-php/ */
