<?php

namespace app\tests\unit\models;

use app\exceptions\DBDataSaveException;
use app\exceptions\ValidationFailedException;
use app\models\forms\CreateResumForm;
use app\tests\unit\classes\ResumeRemake;
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
        $resume = $this->getMockBuilder(ResumeRemake::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->expectException(ValidationFailedException::class);

        $this->object->createResum($resume, $this->markdownParser);
    }

    public function testDataSaveFailed()
    {
        $resume = $this->getMockBuilder(ResumeRemake::class)
            ->onlyMethods(['save'])
            ->disableOriginalConstructor()
            ->getMock();
        
        $resume->expects($this->once())
            ->method('save')
            ->will($this->returnValue(false));
        
        $this->object->name = 'Something';
        $this->object->english_level = 'Something';
        $this->object->github = 'https://github.com/nickname';
        $this->object->description = 'Something';
        $this->object->skills = 'Something';

        $this->expectException(DBDataSaveException::class);

        $this->object->createResum($resume, $this->markdownParser);
    }

    public function testCreatResumeSuccess()
    {
        $resume = $this->getMockBuilder(ResumeRemake::class)
            ->onlyMethods(['save'])
            ->disableOriginalConstructor()
            ->getMock();
        
        $resume->expects($this->once())
            ->method('save')
            ->will($this->returnValue(true));
        
        $this->object->name = 'Something';
        $this->object->english_level = 'Something';
        $this->object->github = 'https://github.com/nickname';
        $this->object->description = 'Something';
        $this->object->skills = 'Something';

        $this->assertTrue($this->object->createResum($resume, $this->markdownParser));
    }
}