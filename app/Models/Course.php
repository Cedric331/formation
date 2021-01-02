<?php

namespace App\Models;

use App\Models\User;
use App\Models\Episode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

        /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'human_created_at',
    ];

    /**
     * Retourne les épisodes de la formation
     *
     * @return void
     */
    public function episodes()
    {
        return $this->hasMany(Episode::class);
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

    public function getHumanCreatedAtAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
