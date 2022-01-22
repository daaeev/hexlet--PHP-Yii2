<?php

namespace app\tests\unit\models;

use app\exceptions\DBDataSaveException;
use app\exceptions\ValidationFailedException;
use app\models\auth\ChangePassForm;
use app\tests\unit\classes\ModelMock;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ChangePassFormTest extends TestCase
{
    public ChangePassForm $object;
    public MockObject $user;
    public MockObject $security;

    public function setUp(): void
    {
        $this->object = new ChangePassForm;

        $this->user = $this->getMockBuilder(ModelMock::class)
        ->addMethods(['save'])
        ->getMock();
    
        $this->security = $this->getMockBuilder(ModelMock::class)
        ->addMethods(['generatePasswordHash', 'generateRandomString'])
        ->getMock();
    }

    public function testChangeSuccess()
    {   
        $this->object->password = "SomeLoooongPassword1234";
        $this->object->password_repeat = "SomeLoooongPassword1234";
        
        $this->security->expects($this->once())
            ->method('generatePasswordHash')
            ->with($this->object->password)
            ->will($this->returnValue('SomeHashasopijq30-43esfj3'));
        
        $this->security->expects($this->once())
            ->method('generateRandomString')
            ->with(32)
            ->will($this->returnValue('SomeRandomStringasopijq30-43esfj3'));
        
        $this->user->expects($this->once())
            ->method('save')
            ->will($this->returnValue(true));
        
        $this->assertTrue($this->object->changePass($this->user, $this->security));
    }

    public function testValidationFailed()
    {
        $this->object->password = "pass";
        $this->object->password_repeat = "SomeLoooongPassword1234";

        $this->expectException(ValidationFailedException::class);

        $this->object->changePass($this->user, $this->security);
    }

    public function testSaveDataFailed()
    {
        $this->object->password = "SomeLoooongPassword1234";
        $this->object->password_repeat = "SomeLoooongPassword1234";
        
        $this->security->expects($this->once())
            ->method('generatePasswordHash')
            ->with($this->object->password)
            ->will($this->returnValue('SomeHashasopijq30-43esfj3'));
        
        $this->security->expects($this->once())
            ->method('generateRandomString')
            ->with(32)
            ->will($this->returnValue('SomeRandomStringasopijq30-43esfj3'));
        
        $this->user->expects($this->once())
            ->method('save')
            ->will($this->returnValue(false));

        $this->expectException(DBDataSaveException::class);

        $this->object->changePass($this->user, $this->security);
    }
}