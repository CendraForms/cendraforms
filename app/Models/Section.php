<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'form_id',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Get the form that owns the section.
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    /**
     * Get the questions that belongs to the section.
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Get the user that owns the section.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
