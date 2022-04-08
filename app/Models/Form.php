<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'anonymized',
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
     * @return array
     */
    public function canBeEditedBy(): array
    {
        return $this
            ->belongsToMany(Role::class, 'form_role_editor')
            ->withTimestamps()
            ->get()
            ->all();
    }

    /**
     * Get the roles that can answer the form.
     *
     * @return array
     */
    public function canBeAnsweredBy(): array
    {
        return $this
            ->belongsToMany(Role::class, 'form_role_answerer')
            ->withTimestamps()
            ->get()
            ->all();
    }

    /**
     * Get the total number of questions that the form has.
     *
     * @return int
     */
    public function questionCount(): int
    {
        $count = 0;

        foreach ($this->sections as $section) {
            foreach ($section['questions'] as $question) {
                if ($question['id']) {
                    $count++;
                }
            }
        }

        return $count;
    }
}
