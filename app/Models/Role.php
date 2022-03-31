<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'active'
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
     * Get the users that belong to the role.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * Get the forms that can be edited by the role.
     *
     * @return BelongsToMany
     */
    public function editableForms(): BelongsToMany
    {
        return $this
            ->belongsToMany(Form::class, 'form_role_editor')
            ->withTimestamps();
    }

    /**
     * Get the forms that can be answered by the role.
     *
     * @return BelongsToMany
     */
    public function answerableForms(): BelongsToMany
    {
        return $this
            ->belongsToMany(Form::class, 'form_role_answerer')
            ->withTimestamps();
    }

    /**
     * Get the roles that its active field is true.
     * Note that it only obtains id and name of active roles.
     * 
     * @return array Array containing all active roles.
     */
    public static function getActiveRoles(): array
    {
        $srcActiveRoles = Role::where('active', true)->get();

        $activeRoles = [];

        foreach ($srcActiveRoles as $srcActiveRole) {
            $role = [
                'id' => $srcActiveRole->id,
                'name' => $srcActiveRole->name,
            ];

            $activeRoles[] = $role;
        }

        return $activeRoles;
    }
}
