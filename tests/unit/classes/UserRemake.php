<?php

namespace app\tests\unit\classes;

use app\models\User;

/**
 * Измененный класс модели User в котором
 * пеереопределен метод __set.
 */
class UserRemake extends User
{
    public function __set($name, $val)
    {
        $this->$name = $val;
    }
}