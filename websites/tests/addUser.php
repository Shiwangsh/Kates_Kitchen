<?php
function addUser($users, $user)
{
    $valid = false;
    if ($user['username'] == '') {
        $valid = false;
    }
    if ($user['password'] == '') {
        $valid = false;
    }
    if ($valid == true) {
        $users->insert($user);
    }

    return $valid;
}
