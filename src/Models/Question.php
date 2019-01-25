<?php

namespace Mirafox\OnlineTest\Models;

use RedBeanPHP\R as R;

/**
 * Class Question
 * @package Mirafox\OnlineTest\Models
 */
class Question
{
    /**
     * @var int - сложность вопроса
     */
    protected $difficulty;
    /**
     * @var int - id вопроса в БД
     */
    protected $id;
    /**
     * @var int - количество показов вопроса
     */
    protected $shows_count;

    /**
     * Question constructor.
     * @param int $difficulty
     * @param int $id
     * @param int $shows_count
     */
    public function __construct(int $difficulty, int $id, int $shows_count)
    {
        $this->difficulty = $difficulty;
        $this->id = $id;
        $this->shows_count = $shows_count;
    }

    /**
     * @return int difficulty
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * @return int id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int shows_count
     */
    public function getShowsCount()
    {
        return $this->shows_count;
    }

    /**
     * Получаем список случайных вопросов из БД
     *
     * @param int $count
     * @return array
     */
    public static function getRandQuestions(int $count)
    {
        return R::getAll("SELECT * FROM questions ORDER BY RAND()*shows_count ASC LIMIT {$count}");
    }

    /**
     * Увеличием количество показов вопроса
     */
    public function updateShowsCount()
    {
        $newShowsCount = $this->shows_count + 1;
        R::exec("UPDATE questions SET shows_count = {$newShowsCount} WHERE ID = {$this->id}");
    }
}