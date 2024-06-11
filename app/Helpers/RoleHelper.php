<?php

namespace App\Helpers;

use App\Models\User;

class RoleHelper
{
    /**
     ** Check role.
     *
     * @param $role
     * @return boolean
     */
    public static function checkRole($role = [], $id = null)
    {
        $result = false;

        if (!$id) {
            $id = auth()->user()->id;
        }

        $user = User::where('id', $id)
            ->whereHas('roles', function ($query) use ($role) {
                $query->whereIn('name', $role);
            })
            ->first();

        if (!empty($user)) {
            $result = true;
        }

        return $result;
    }
}
