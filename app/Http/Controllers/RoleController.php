<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

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
    
    /**
     * Return now the specified role id
     *
     * @param Integer $id specified role id
     */
    public function getRole($id)
    {
        $role = Role::findOrFail($id);

        return $role;

        //In Future
        //return view('');
    }
}