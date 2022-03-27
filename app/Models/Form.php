<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Form extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'user_id',
        'published',
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
     * Get the user that owns the form.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the sections that belong to the form.
     *
     * @return HasMany
     */
    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    /**
     * Get the roles that can edit the form.
     *
     * @return BelongsToMany
     */
    public function canBeEditedBy(): BelongsToMany
    {
        return $this
            ->belongsToMany(Role::class, 'form_role_editor')
            ->withTimestamps();
    }

    /**
     * Get the roles that can answer the form.
     *
     * @return BelongsToMany
     */
    public function canBeAnsweredBy(): BelongsToMany
    {
        return $this
            ->belongsToMany(Role::class, 'form_role_answerer')
            ->withTimestamps();
    }

}
