<?php

use app\components\helpers\interface\RoleHelperInterface;
use app\components\helpers\RoleHelper;

$container = Yii::$container;

$container->setSingleton(RoleHelperInterface::class, RoleHelper::class);