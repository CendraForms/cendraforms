<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FormRoleAnswerer extends Pivot
{
    /**
     * The pivot table associated to Form and Role models.
     * A Form can be answered by many Roles.
     * A Role can answer many Forms.
     *
     * @var string
     */
    protected $table = 'form_role_answerer';
}
