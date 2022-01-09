<?php

namespace app\tests\unit\models;

use app\exceptions\DBDataSaveException;
use app\exceptions\ValidationFailedException;
use app\models\forms\CreateVacancieForm;
use app\tests\unit\classes\ModelMock;
use PHPUnit\Framework\TestCase;
use Parsedown;

class CreateVacancieFormTest extends TestCase
{
    public CreateVacancieForm $object;
    public Parsedown $markdownParser;

    public function setUp(): void
    {
        $this->object = new CreateVacancieForm();
        $this->markdownParser = new Parsedown;
    }

    public function testCreateSuccess()
    {
        $vacancie = $this->getMockBuilder(ModelMock::class)
            ->addMethods(['save'])
            ->disableOriginalConstructor()
            ->getMock();
        
        $vacancie->expects($this->once())
            ->method('save')
            ->will($this->returnValue(true));

        $this->object->level = 'Something';
        $this->object->type_of_work = 'Something';
        $this->object->currency = 'Something';
        $this->object->position = 'Something';
        $this->object->city = 'Something';
        $this->object->company = 'Something';
        $this->object->duties = 'Something';

        $this->assertTrue($this->object->createVacancie($vacancie, $this->markdownParser));
    }

    public function testValidationFailed()
    {
        $vacancie = $this->getMockBuilder(ModelMock::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->object->level = 'Something';
        $this->object->type_of_work = 'Something';
        $this->object->currency = 'Something';
        $this->object->position = 'Something';
        $this->object->city = 'Something';
        $this->object->company = 'Something';
        $this->object->duties = 'Something';
        $this->object->company_site = 'Incorrect url';
        $this->object->contact_telegram = 'Incorrect url';
        $this->object->contact_email = 'Incorrect email';

        $this->expectException(ValidationFailedException::class);

        $this->object->createVacancie($vacancie, $this->markdownParser);
    }

    public function testSaveDataFailde()
    {
        $vacancie = $this->getMockBuilder(ModelMock::class)
            ->addMethods(['save'])
            ->disableOriginalConstructor()
            ->getMock();

        $vacancie->expects($this->once())
            ->method('save')
            ->will($this->returnValue(false));

        $this->object->level = 'Something';
        $this->object->type_of_work = 'Something';
        $this->object->currency = 'Something';
        $this->object->position = 'Something';
        $this->object->city = 'Something';
        $this->object->company = 'Something';
        $this->object->duties = 'Something';

        $this->expectException(DBDataSaveException::class);

        $this->object->createVacancie($vacancie, $this->markdownParser);
    }
}