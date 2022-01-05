<?php

use app\components\helpers\interface\RoleHelperInterface;
use app\components\helpers\RoleHelper;
use yii\rbac\DbManager;
use yii\rbac\ManagerInterface;

$container = Yii::$container;

$container->setSingleton(RoleHelperInterface::class, RoleHelper::class);
$container->setSingleton(ManagerInterface::class, DbManager::class);