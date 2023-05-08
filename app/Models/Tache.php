<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'begin_at',
        'finish_at',
        'beginned_at',
        'finished_at'
    ];

    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }
}
