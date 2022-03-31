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
     * Return Forms to be Answered
     *
     * @param Integer $limit forms limit
     * @return Object Forms to be Answered
     */
    public function formsToBeAnswered($limit)
    {
        // Get roles the logged user
        $roles = $this->roles;

        $answerableForms = [];
        // Get forms that logged user have permission to answer
        foreach ($roles as $role) {
            $answerableForms[] = $role->answerableForms;
        }

        $formsAvaiable = [];
        // Filter forms where the field published is equals true
        foreach ($answerableForms as $answerableForm) {
            $formsAvaiable[] = $answerableForm->where('published', true);
        }

        // Return forms avaiable object
        return $formsAvaiable[0]->take($limit);
    }

    /**
     * Return Answered Forms
     *
     * @param Integer $limit forms limit
     * @return Object Forms Answered
     */
    public function answeredForms($limit)
    {
        // Get answers the logged user
        $answers = $this->answers;

        $forms = [];
        // Get forms that logged user the answer
        foreach ($answers as $answer) {
            $forms[] = $answer->question->section->form;
        }

        // Get Forms Avaiable
        $formsAvaiable = $this->formsToBeAnswered($limit);

        $formsAnsweredAvaiable = [];
        // Filter Forms where answered forms is avaiable
        foreach ($formsAvaiable as $formAvaiable) {
            foreach ($forms as $form) {
                if ($formAvaiable->id == $form->id) {
                    $formsAnsweredAvaiable[] = $form;
                }
            }
        }

        //Return forms avaiable and answer object
        return $formsAnsweredAvaiable;
    }

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
}
