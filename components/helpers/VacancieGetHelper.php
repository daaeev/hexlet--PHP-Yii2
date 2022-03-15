<?php

namespace app\components\helpers;

use app\components\helpers\interface\GetPaginationDataTrait;
use app\components\helpers\interface\VacancieGetInterface;
use app\exceptions\IDNotFoundException;
use app\models\Vacancie;
use Yii;

/**
 * Класс-хелпер для получения данных из таблицы vacancie
 */
class VacancieGetHelper implements VacancieGetInterface
{
    public int $pageSize = 20;

    use GetPaginationDataTrait;

    public function getAll(): array
    {
        $query = Vacancie::find()
            ->where(['status' => Vacancie::STATUS_CONFIRMED])
            ->orderBy('pub_date DESC');

        $data = $this->getPaginationData($query, 'vacancies');

        return $data;
    }

    public function findById(int $id): Vacancie
    {
        $model = Vacancie::find()
            ->where(['status' => Vacancie::STATUS_CONFIRMED, 'id' => $id])
            ->one();
        
        if ($model) {
            return $model;
        }

        throw new IDNotFoundException;
    }

    public function findByAuthor(int $author_id): array
    {
        $models = Vacancie::find()
            ->where(['author_id' => $author_id])
            ->all();
        
        return $models;
    }

    public function getFiltersData(): array
    {
        $level = [
            '' => Yii::t('main', 'Выберите уровень'),
            'Джуниор' => Yii::t('main', 'Джуниор'),
            'Мидл' => Yii::t('main', 'Мидл'),
            'Сеньор' => Yii::t('main', 'Сеньор'),
            'Тимлид' => Yii::t('main', 'Тимлид'),
        ];

        $vacancies_technologies = Vacancie::find()
            ->select('technologies')
            ->where(['!=', 'technologies', ''])
            ->column();

        $technologies = $this->normalizedTechnologiesFilter($vacancies_technologies);

        return compact('level', 'technologies');
    }

    public function getAllByFilters(array $filters): array
    {
        $query = Vacancie::find()
            ->where(['status' => Vacancie::STATUS_CONFIRMED])
            ->orderBy('pub_date DESC');
        
        foreach ($filters as $column => $value) {
            $query->andFilterWhere(['like', $column, $value]);
        }

        $data = $this->getPaginationData($query, 'vacancies');

        return $data;
    }

    public function findSimilarVacancies($vacancie, int $limit = 5): array
    {
        $vacancies = Vacancie::find()
            ->where(['status' => Vacancie::STATUS_CONFIRMED])
            ->andWhere(['!=', 'id', $vacancie->id])
            ->andWhere(['like', 'level', $vacancie->level])
            ->andWhere(['like', 'city', $vacancie->city])
            ->orderBy('pub_date DESC')
            ->limit($limit)
            ->all();

        return $vacancies;
    }

    /**
     * Метод нормализует массив с технологиями, а именно:
     * приводит массив к виду ['php' => 'php'] и
     * убирает повторения
     * @param array $technologies массив технологий всех вакансий в таблице vacancie
     * @return array нормализованный массив технологий
     */
    protected function normalizedTechnologiesFilter(array $technologies): array
    {
        $norm_tech = ['' => Yii::t('main', 'Технологии')];

        foreach ($technologies as $tech) {
            $tech_array = explode(', ', $tech);
            $tech_array = array_unique($tech_array);

            foreach ($tech_array as $technologie) {
                $norm_tech[$technologie] = $technologie;
            }
        }

        return $norm_tech;
    }
}