<?php

namespace Mirafox\OnlineTest\Models;

use Mirafox\OnlineTest\Application;

/**
 * Class TestUser
 * @package Mirafox\OnlineTest\Models
 */
class TestUser
{
    /**
     * @var int - интелект тестируемого пользователя
     */
    protected $intellect;

    /**
     * TestUser constructor.
     * @param $intellect
     */
    public function __construct($intellect)
    {
        $this->intellect = $intellect;
    }

    /**
     * @return mixed
     */
    public function getIntellect()
    {
        return $this->intellect;
    }

    /**
     * Функция возвращает результат прохождения тестируемым пользователем вопроса
     *
     * @param Question $question - вопрос
     * @return string
     */
    public function passQuestion(Question $question)
    {
        // Если сложность вопроса = 100
        if ($question->getDifficulty() == 100) {
            return 'Нет';
        }
        // Если сложность вопроса = 0
        elseif ( $question->getDifficulty() == 0) {
            // Если интелект пользователя больше 0
            if( $this->intellect > 0 ) {
                $passQuestionChance = 100;
            }
            else {
                $passQuestionChance = 50;
            }
        }
        // Если интелект пользователя равен 100
        elseif ($this->intellect == 100) {
            $passQuestionChance = 100;
        }
        // Если интелект пользователя меньше сложности вопроса
        else if ($this->intellect < $question->getDifficulty()) {
            // Получаем вероятность правильного ответа при условии что сложность вопроса = 100%
            // и делим это значение на дополнительный коэфициент, чтобы уменьшить вероятность правильного ответа
            // в случае когда пользватель интелектом меньше, чем сложность вопроса
            $passQuestionChance = ($this->intellect / ($question->getDifficulty() / 100)) / 4;
        }
        // Во всех других случаях
        else {
            $passQuestionChance = Application::getInstance()->get('chanceAnswerWhenKnow');
        }

        if (rand(0, 100) <= $passQuestionChance) return 'Да';

        return 'Нет';
    }
}