<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;

class RoleController extends Controller
{
    /**
     * Return now the specified role id
     *
     * (And return view "in future")
     *
     * @param Integer $id specified role id
     */
    public function getRole($id)
    {
        $role = Roles::findOrFail($id);

        return $role;

        //In Future
        //return view('');
    }
}