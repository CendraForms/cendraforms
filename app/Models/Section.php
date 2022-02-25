<?php

namespace App\Models;

use App\Models\User;
use App\Models\Form;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'form_id',
        'user_id',
        'active'
    ];

    /**
     * Get the form that owns the section.
     */
    public function forms()
    {
        return $this->belongsTo(Form::class);
    }

    /**
     * Get the user that owns the section.
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
