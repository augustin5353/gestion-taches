<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
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

    protected $dates = ['begin_at', 'finish_at', 'beginned_at', 'beginned_at']; 

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function group()
    {
        return $this->belongsTo(Task::class);
    }

    public function getDate(string $date)
    {
        

        $date = Carbon::parse($date);   

        return $date->translatedFormat('d F Y H:i');
    }
    public function parseDateInCarbon(string $date)
    {
        return Carbon::parse($date);
    }

    public function getTaskStatus()
    {
        $begin_at = $this->begin_at;
        $finish_at = $this->finish_at;
        $beginned_at = $this->beginned_at;
        $finished_at = $this->finished_at;

        $status = '';
        if($beginned_at !== null && $finished_at === null)
        {
            $status = 'En cours';
        }
        elseif($beginned_at !== null && $finished_at !== null)
        {
            $status = 'Terminée';
        }
        elseif($beginned_at === null)
        {
            $status = 'Non démarrée';
        }

        return $status;
    }

    public function scopeRecentTask(Builder $builder, ?string $column = null)
    {
        return $builder->orderBy($column ? $column : 'finish_at', 'asc');
    }

    public function scopeCompareDate(Builder $builder, string $date1, $date2)
    {
        return $builder->whereDate($date1, ">", $date2);
    }
    public function scopeNullDate(Builder $builder, ?string $column = null, ?bool $type = true)
    {
        if($type)
        {
            return $builder->whereNull($column ? $column : 'finished_at');
        }
        else
        {
            return $builder->whereNotNull($column ? $column : 'finished_at');
        }
        
    }

}
