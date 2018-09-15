<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends \Caffeinated\Shinobi\Models\Role
{

    function scopeName($query, $name)
    {
        if ($name) {
            $id_roles = [];

            $roles = Role::Select(DB::raw('name, id'))
                            ->having('name', 'LIKE', "%$name%")->get();

            foreach ($roles as $role) {
                array_push($id_roles, $role->id);
            }

            return $query->whereIn('id', $id_roles);
        }

        return $query;
    }

}
