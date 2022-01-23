<?php

namespace app\tests\unit\models;

use app\exceptions\DBDataSaveException;
use app\exceptions\ValidationFailedException;
use app\models\forms\CreateResumForm;
use app\tests\unit\classes\ModelMock;
use Codeception\PHPUnit\TestCase;
use Parsedown;

class CreateResumTest extends TestCase
{
    public CreateResumForm $object;
    public Parsedown $markdownParser;

    public function setUp(): void
    {
        $this->object = new CreateResumForm;
        $this->markdownParser = new Parsedown;
    }

    public function testValidaionFailed()
    {
        $resume = $this->getMockBuilder(ModelMock::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->expectException(ValidationFailedException::class);

        $this->object->createResum($resume, $this->markdownParser);
    }

    public function testDataSaveFailed()
    {
        $resume = $this->getMockBuilder(ModelMock::class)
            ->addMethods(['save'])
            ->disableOriginalConstructor()
            ->getMock();
        
        $resume->expects($this->once())
            ->method('save')
            ->will($this->returnValue(false));
        
        $this->object->title = 'Something';
        $this->object->english = 'Something';
        $this->object->github = 'https://github.com/nickname';
        $this->object->description = 'Something';
        $this->object->skills = 'Something';

        $this->expectException(DBDataSaveException::class);

        $this->object->createResum($resume, $this->markdownParser);
    }

    public function testCreatResumeSuccess()
    {
        $resume = $this->getMockBuilder(ModelMock::class)
            ->addMethods(['save'])
            ->disableOriginalConstructor()
            ->getMock();
        
        $resume->expects($this->once())
            ->method('save')
            ->will($this->returnValue(true));
        
        $this->object->title = 'Something';
        $this->object->english = 'Something';
        $this->object->github = 'https://github.com/nickname';
        $this->object->description = 'Something';
        $this->object->skills = 'Something';

        $this->assertTrue($this->object->createResum($resume, $this->markdownParser));
    }
}