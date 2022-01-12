<?php

namespace app\tests\unit\models;

use app\components\helpers\DBValidator;
use app\components\helpers\interface\DBValidatorInterface;
use app\exceptions\DBDataSaveException;
use app\exceptions\IDNotFoundException;
use app\exceptions\ValidationFailedException;
use app\models\forms\CreateCommentForm;
use app\tests\unit\classes\ModelMock;
use Parsedown;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CreateCommentTest extends TestCase
{
    public CreateCommentForm $object;
    public Parsedown $parser;
    public MockObject $validator;

    public function setUp(): void
    {
        $this->object = new CreateCommentForm;
        $this->parser = new Parsedown;
        $this->validator = $this->getMockBuilder(DBValidator::class)
            ->onlyMethods(['resumeExist', 'commentExist'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testValidationFailde()
    {
        $comment = $this->getMockBuilder(ModelMock::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->expectException(ValidationFailedException::class);

        $this->object->createComment($comment, $this->parser, $this->validator, 1);
    }

    public function testValidationCommentLengthFailed()
    {
        $comment = $this->getMockBuilder(ModelMock::class)
            ->disableOriginalConstructor()
            ->getMock();

        // 201 символ
        $this->object->content = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni deleniti beatae quo consequatur harum et, facilis sit molestias cumque nostrum eum atque excepturi maxime perferendis laudantium corrupti!';
        
        $this->expectException(ValidationFailedException::class);

        $this->object->createComment($comment, $this->parser, $this->validator, 1, 1);
    }

    public function testResumeNotExist()
    {
        $comment = $this->getMockBuilder(ModelMock::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->object->content = 'Lorem ipsum dolos';

        $this->validator->expects($this->once())
            ->method('resumeExist')
            ->will($this->returnValue(false));
        
        $this->expectException(IDNotFoundException::class);

        $this->object->createComment($comment, $this->parser, $this->validator, 1);
    }

    public function testCommentNotExist()
    {
        $comment = $this->getMockBuilder(ModelMock::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->object->content = 'Lorem ipsum dolos';

        $this->validator->expects($this->once())
            ->method('resumeExist')
            ->will($this->returnValue(true));

        $this->validator->expects($this->once())
            ->method('commentExist')
            ->will($this->returnValue(false));
        
        $this->expectException(IDNotFoundException::class);

        $this->object->createComment($comment, $this->parser, $this->validator, 1, 1);
    }


    public function testSaveDataFailed()
    {
        $comment = $this->getMockBuilder(ModelMock::class)
            ->addMethods(['save'])
            ->disableOriginalConstructor()
            ->getMock();

        $comment->expects($this->once())
            ->method('save')
            ->will($this->returnValue(false));

        $this->object->content = 'Lorem ipsum dolos';

        $this->validator->expects($this->once())
            ->method('resumeExist')
            ->will($this->returnValue(true));

        $this->validator->expects($this->once())
            ->method('commentExist')
            ->will($this->returnValue(true));
        
        $this->expectException(DBDataSaveException::class);

        $this->object->createComment($comment, $this->parser, $this->validator, 1, 1);
    }

    public function testSaveDataSuccess()
    {
        $comment = $this->getMockBuilder(ModelMock::class)
            ->addMethods(['save'])
            ->disableOriginalConstructor()
            ->getMock();

        $comment->expects($this->exactly(2))
            ->method('save')
            ->will($this->returnValue(true));

        $this->object->content = 'Lorem ipsum dolos';

        $this->validator->expects($this->exactly(2))
            ->method('resumeExist')
            ->will($this->returnValue(true));

        $this->validator->expects($this->once())
            ->method('commentExist')
            ->will($this->returnValue(true));
        
        $this->assertTrue($this->object->createComment($comment, $this->parser, $this->validator, 1, 1));
        $this->assertTrue($this->object->createComment($comment, $this->parser, $this->validator, 1));
    }
}