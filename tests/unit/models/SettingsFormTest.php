<?php

namespace app\tests\unit\models;

use app\exceptions\DBDataSaveException;
use app\exceptions\ValidationFailedException;
use app\models\forms\AccountSettingsForm;
use Codeception\PHPUnit\TestCase;
use app\tests\unit\classes\UserRemake;

class SettingsFormTest extends TestCase
{
    public AccountSettingsForm $object;

    public function setUp(): void 
    {
        $this->object = new AccountSettingsForm;
    }

    public function testSaveDataSuccess()
    {
        $user = $this->getMockBuilder(UserRemake::class)
            ->onlyMethods(['save'])
            ->disableOriginalConstructor()
            ->getMock();
        
        $user->expects($this->once())
            ->method('save')
            ->will($this->returnValue(true));

        $this->assertTrue($this->object->saveUserSettings($user));
    }

    public function testDataValidationFailed()
    {
        $this->object->user_name = 'An';

        $user = $this->getMockBuilder(UserRemake::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->expectException(ValidationFailedException::class);

        $this->object->saveUserSettings($user);
    }

    public function testSaveDataInDbFailed()
    {
        $user = $this->getMockBuilder(UserRemake::class)
            ->onlyMethods(['save'])
            ->disableOriginalConstructor()
            ->getMock();
        
        $user->expects($this->once())
            ->method('save')
            ->will($this->returnValue(false));

        $this->expectException(DBDataSaveException::class);

        $this->object->saveUserSettings($user);
    }
}