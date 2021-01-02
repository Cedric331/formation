<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Episode extends Model
{
    use HasFactory;

    /**
     * Retourne la formation de l'épisode
     *
     * @return void
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Retourne l'utilisateur qui a créé la formation
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
