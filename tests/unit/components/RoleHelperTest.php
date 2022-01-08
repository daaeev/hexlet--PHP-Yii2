<?php

namespace app\tests\unit\components;

use PHPUnit\Framework\TestCase;
use yii\rbac\DbManager;
use app\components\helpers\RoleHelper;
use app\tests\unit\classes\UserRemake;
use Exception;
use yii\rbac\Role;

class RoleHelperTest extends TestCase
{
    public RoleHelper $object;

    public function setUp(): void
    {
        $authManager = $this->getMockBuilder(DbManager::class)
            ->onlyMethods(['assign', 'revokeAll', 'getRole'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->object = new RoleHelper($authManager);
    }

    public function testAssignRoleSuccess()
    {
        $role_name = 'admin';
        $user_id = 1;

        $this->object->getAuthManager()
            ->expects($this->once())
            ->method('revokeAll')
            ->will($this->returnValue(true))
            ->with($user_id);

        $role = new Role;
        $this->object->getAuthManager()
            ->expects($this->once())
            ->method('getRole')
            ->will($this->returnValue($role))
            ->with($role_name);

        $this->object->getAuthManager()
            ->expects($this->once())
            ->method('assign')
            ->with($role, $user_id);
        
        $this->assertTrue($this->object->assignRole($role_name, $user_id));
    }

    public function testUnSuccessRevoke()
    {
        $user_id = 1;

        $this->expectException(Exception::class);

        $this->object->getAuthManager()
            ->expects($this->once())
            ->method('revokeAll')
            ->will($this->returnValue(false))
            ->with($user_id);

        $this->assertTrue($this->object->assignRole('', $user_id));
    }

    public function testUnSuccessGetRole()
    {
        $user_id = 1;

        $this->expectException(Exception::class);

        $this->object->getAuthManager()
            ->expects($this->once())
            ->method('revokeAll')
            ->will($this->returnValue(true))
            ->with($user_id);

        $this->object->getAuthManager()
            ->expects($this->once())
            ->method('getRole')
            ->will($this->returnValue(null))
            ->with('');

        $this->assertTrue($this->object->assignRole('', $user_id));
    }

    public function testSetUserStatusSuccess()
    {
        $role_name = 'admin';
        $user = $this->getMockBuilder(UserRemake::class)
            ->onlyMethods(['save'])
            ->disableOriginalConstructor()
            ->getMock();
        
        $user->expects($this->once())
            ->method('save')
            ->will($this->returnValue(true));

        $this->assertTrue($this->object->setUserStatus($user, $role_name));
    }

    public function testUndefinedRoleStatus()
    {
        $role_name = 'undefined role';
        $user = $this->getMockBuilder(UserRemake::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->expectException(Exception::class);
        $this->object->setUserStatus($user, $role_name);
    }

    public function testUnSuccessValidation()
    {
        $role_name = 'admin';
        $user = $this->getMockBuilder(UserRemake::class)
            ->onlyMethods(['save'])
            ->disableOriginalConstructor()
            ->getMock();
        
        $user->expects($this->once())
            ->method('save')
            ->will($this->returnValue(false));

        $this->expectException(Exception::class);
        $this->object->setUserStatus($user, $role_name);
    }
}