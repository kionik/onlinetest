<?php

namespace Mirafox\OnlineTest\Models;

use RedBeanPHP\R as R;

/**
 * Класс скорее избыточен сам по себе, но нужен для отделения логики тестов и результатов тестирования
 *
 * Class TestResult
 * @package Mirafox\OnlineTest\Models
 */
class TestResult
{
    /**
     * @var string
     */
    protected $tableName = 'testresults';

    /**
     * @param array $result
     * @return int|string
     */
    public function add(array $result)
    {
        $testResult = R::dispense($this->tableName);
        $testResult->user_intellect = $result['user_intellect'];
        $testResult->min_difficult = $result['min_difficult'];
        $testResult->max_difficult = $result['max_difficult'];
        $testResult->correct_answers_count = $result['correct_answers_count'];
        $testResult->questions_count = $result['questions_count'];
        return R::store($testResult);
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return R::findAll($this->tableName);
    }
}