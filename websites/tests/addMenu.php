<?php
function addMenu($menus, $menu)
{
    $valid = false;
    if ($menu['name'] == '') {
        $valid = false;
    }
    if ($menu['description'] == '') {
        $valid = false;
    }
    if ($menu['price'] == '') {
        $valid = false;
    }
    if ($menu['image'] == '') {
        $valid = false;
    }
    if ($valid == true) {
        $menus->insert($menu);
    }

    return $valid;
}
