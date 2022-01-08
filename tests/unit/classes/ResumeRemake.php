<?php

namespace app\tests\unit\classes;

use app\models\User;

/**
 * Измененный класс модели Resume в котором
 * пеереопределен метод __set.
 */
class ResumeRemake extends User
{
    public function __set($name, $val)
    {
        $this->$name = $val;
    }
}