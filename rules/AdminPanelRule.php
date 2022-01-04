<?php

namespace app\rules;

use app\models\User;
use yii\rbac\Rule;

class AdminPanelRule extends Rule 
{
    public $name = 'AdminPanelAccess';

    public function execute($user_id, $item, $params)
    {
        $user = $user_id ? User::findIdentity($user_id) : null;

        if (!empty($user) && $user->status > 0 && $user->status < 3)
            return true;
            
        return false;
    }
}