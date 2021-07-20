<?php
function addCategory($categories, $category)
{
    $valid = false;
    if ($category['name'] == '') {
        $valid = false;
    }
    if ($valid == true) {
        $categories->insert($category);
    }

    return $valid;
}
