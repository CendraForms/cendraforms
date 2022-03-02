<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Section;
use App\Models\Answer;
use App\Models\Form;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
        'avatar',
        'external_id',
        'external_auth',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get all of the sections for the user.
     */
    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    /**
     * Get all of the answers for the user.
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * Get all of the forms for the user.
     */
    public function forms()
    {
        return $this->hasMany(Form::class);
    }
}
