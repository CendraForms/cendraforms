<?php

namespace App\Models;
use App\Models\User;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Form extends Model
{
    use HasApiTokens,HasFactory,Notifiable;


  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable= [
        'name',
        'description',
        'user_id',
        'active',
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
     * Get the sections that belongs to the form.
     */
    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}


