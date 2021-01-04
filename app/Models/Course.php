<?php

namespace App\Models;

use App\Models\User;
use App\Models\Episode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    use Authorizable;

    protected static function booted()
    {
        static::creating(function ($course){
            $course->user_id = Auth::user()->id;
        });
    }

    protected $appends = ['update', 'human_created_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
    ];

    public function getUpdateAttribute(){
        return $this->can('update-cours', $this);
    }

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
