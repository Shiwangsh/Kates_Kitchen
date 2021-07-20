<?php

require('addMenu.php');
require('DatabaseTable.php');
class AddMenuTest extends \PHPUnit\Framework\TestCase
{
    public function testEmptyname()
    {
        $pdo = new PDO('mysql:dbname=kitchen;host=127.0.0.1', 'student', 'student');
        $menus = new DatabaseTable($pdo, 'menus');
        $menu = [
            'name' => '',
            'description' => 'This pub classic is made  fresh in house with your choice of chunky chips or curly fries.',
            'price' => '10',
            'image' => 'images/image1.jpg'
        ];

        $valid = addMenu($menus, $menu);
        $this->assertFalse($valid);
    }

    public function testEmptyDescription()
    {
        $pdo = new PDO('mysql:dbname=kitchen;host=127.0.0.1', 'student', 'student');
        $menus = new DatabaseTable($pdo, 'menus');
        $menu = [
            'name' => 'Burger and chips',
            'description' => '',
            'price' => '10',
            'image' => 'images/image1.jpg'
        ];

        $valid = addMenu($menus, $menu);
        $this->assertFalse($valid);
    }

    public function testEmptyPrice()
    {
        $pdo = new PDO('mysql:dbname=kitchen;host=127.0.0.1', 'student', 'student');
        $menus = new DatabaseTable($pdo, 'menus');
        $menu = [
            'name' => 'Burger and chips',
            'description' => 'This pub classic is made  fresh in house with your choice of chunky chips or curly fries.',
            'price' => '',
            'image' => 'images/image1.jpg'
        ];

        $valid = addMenu($menus, $menu);
        $this->assertFalse($valid);
    }

    public function testEmptyImage()
    {
        $pdo = new PDO('mysql:dbname=kitchen;host=127.0.0.1', 'student', 'student');
        $menus = new DatabaseTable($pdo, 'menus');
        $menu = [
            'name' => 'Burger and chips',
            'description' => 'This pub classic is made  fresh in house with your choice of chunky chips or curly fries.',
            'price' => '1',
            'image' => ''
        ];

        $valid = addMenu($menus, $menu);
        $this->assertFalse($valid);
    }
}
