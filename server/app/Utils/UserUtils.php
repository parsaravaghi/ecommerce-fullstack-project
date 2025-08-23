<?php

namespace App\Utils;


class UserUtils
{
    public function userPermission($user , int $role)
    {
        if(!$user || $user['role'] < $role)
            abort(404); // send not found if user wouldn't be admin

        request()->merge([
            "owner" => $user['id'] , // get the id from query
            "role" => $user['role'] , // merge the role to the main request
            "is_verified" => $user['role'] > 1 // if the user role would be admin any changes is validated
        ]);
    }

}
