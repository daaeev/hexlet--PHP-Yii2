<?php

use app\components\helpers\interface\ResumeGetInterface;
use app\components\helpers\interface\RoleHelperInterface;
use app\components\helpers\ResumeGetHelper;
use app\components\helpers\RoleHelper;
use yii\rbac\DbManager;
use yii\rbac\ManagerInterface;

$container = Yii::$container;

$container->setSingleton(RoleHelperInterface::class, RoleHelper::class);
$container->setSingleton(ManagerInterface::class, DbManager::class);
$container->setSingleton(ResumeGetInterface::class, ResumeGetHelper::class);

$markDownParser = new Parsedown;
$markDownParser->setSafeMode(true);

$container->set(Parsedown::class, $markDownParser);