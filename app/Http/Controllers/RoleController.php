<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Returns all roles
     * 
     * @return JSON
     */
    public static function getRoles()
    {
        return Role::get();
    }
}
