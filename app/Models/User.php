<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the roles that belong to the user.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * Get the sections that belong to the user.
     *
     * @return HasMany
     */
    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    /**
     * Get the answers that belong to the user.
     *
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * Get the forms that belong to the user.
     *
     * @return HasMany
     */
    public function forms(): HasMany
    {
        return $this->hasMany(Form::class);
    }

    // juanjo -> està fent funció que retorna tots els formularis que l'usuari té per respondre
    // juanjo -> està fent funció que retorna tots els formularis que l'usuari ja ha respost

    /**
     * Checks if user can answer parsed Form.
     * 
     * @param int Form id where to obtain the roles
     * @return bool true if user can answer parsed form, otherwise false.
     */
    public function canAnswerForm(int $formId): bool
    {
        // get user roles
        $userRoles = $this->roles->all();

        // get roles that can answer parsed form
        $formRoleAnswerers = Form::where('id', '=', $formId)
                                    ->first()
                                    ->canBeAnsweredBy()
                                    ->get()
                                    ->all();

        // find if user can answer the form
        foreach ($formRoleAnswerers as $formRoleAnswerer) {
            foreach ($userRoles as $userRole) {
                dd($formRoleAnswerer->name);
                if ($formRoleAnswerer->id == $userRole->id) {
                    return true;
                }
            }
        }

        return false;
    }
}
