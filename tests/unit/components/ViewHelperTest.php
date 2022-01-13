<?php

use PHPUnit\Framework\TestCase;
use app\components\helpers\ViewHelper;
use app\tests\unit\classes\ModelMock;

class ViewHelperTest extends TestCase
{
    public function testNumToWordFunction()
    {
        $words = ['ответ', 'ответа', 'ответов'];

        $this->assertEquals($words[0], ViewHelper::numToWord(1, $words));
        $this->assertEquals($words[1], ViewHelper::numToWord(2, $words));
        $this->assertEquals($words[2], ViewHelper::numToWord(5, $words));
    }

    public function testCreateVacancieTitleFunction()
    {
        $model = $this->getMockBuilder(ModelMock::class)
            ->getMock();

        $model->level = 'Джуниор';
        $model->position = 'php-разработчик';
        $model->company = 'company';
        $model->money = null;
        $this->assertEquals('Джуниор php-разработчик - company', ViewHelper::createVacancieTitle($model));

        $model->money_from = '200';
        $model->currency = '$';
        $this->assertEquals('Джуниор php-разработчик от 200 $ - company', ViewHelper::createVacancieTitle($model));

        $model->money_to = '300';
        $this->assertEquals('Джуниор php-разработчик от 200 до 300 $ - company', ViewHelper::createVacancieTitle($model));

        $model->money = 'На руки';
        $this->assertEquals('Джуниор php-разработчик от 200 до 300 $ (На руки) - company', ViewHelper::createVacancieTitle($model));
    }

    public function testCreateSalaryTitleFunction()
    {
        $model = $this->getMockBuilder(ModelMock::class)
            ->getMock();

        $model->money = null;
        $this->assertEquals('', ViewHelper::createSalaryTitle($model));

        $model->money_from = '200';
        $model->currency = '$';
        $this->assertEquals('от 200 $', ViewHelper::createSalaryTitle($model));

        $model->money_to = '300';
        $this->assertEquals('от 200 до 300 $', ViewHelper::createSalaryTitle($model));

        $model->money = 'На руки';
        $this->assertEquals('от 200 до 300 $ (На руки)', ViewHelper::createSalaryTitle($model));
    }
}