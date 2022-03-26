<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FormRoleEditor extends Pivot
{
    /**
     * The pivot table associated to the Form and Role models.
     * A Form can be edited by many Roles.
     * A Role can edit many Forms.
     *
     * @var string
     */
    protected $table = 'form_role_editor';
}
