<?php

namespace Mirafox\OnlineTest\Models;

use Mirafox\OnlineTest\Application;

/**
 * Class Test
 * @package Mirafox\OnlineTest\Models
 */
class Test
{
    /**
     * @var int - максимальная сложность вопроса
     */
    protected $maxDifficulty;
    /**
     * @var int - минимальная сложность вопроса
     */
    protected $minDifficulty;
    /**
     * @var array - массив вопросов
     */
    protected $questions;
    /**
     * @var TestUser - тестируемый пользователь
     */
    protected $user;
    /**
     * @var - количество вопросов
     */
    protected $questionsCount;

    /**
     * Test constructor.
     * @param int $minDifficulty
     * @param int $maxDifficulty
     * @param int $userIntellect
     */
    public function __construct(int $minDifficulty, int $maxDifficulty, int $userIntellect)
    {
        $this->maxDifficulty = $maxDifficulty;
        $this->minDifficulty = $minDifficulty;
        $this->questionsCount = Application::getInstance()->get('questionCount');
        $this->user = new TestUser($userIntellect);
        $this->setQuestions();
    }

    /**
     * Функция возвращает результат прохождения тестирования
     *
     * @return array
     */
    public function passTest()
    {
        $result = [];
        $correct_answers_count = 0;
        // Проходим по списку вопросов
        foreach ($this->questions as $key => $question) {

            // Получаем результат прохождения вопроса
            $passQuestion = $this->user->passQuestion($question);

            // Формируем результирующий массив ответа (для постороения таблицы)
            $result['ANSWERS'][] = [
                'NUM' => $key + 1,
                'ID' => $question->getId(),
                'SHOWS_COUNT' => $question->getShowsCount(),
                'QUESTION_DIFFICULTY' => $question->getDifficulty(),
                'RESULT' => $passQuestion
            ];

            // Считаем количество правильных ответов
            if ($passQuestion == 'Да') $correct_answers_count++;

            // Обновляем у вопроса количество показов данного вопроса
            $question->updateShowsCount();
        }

        // Добавляем в результирующий массив количество правильных ответов
        $result['CORRECT_ANSWERS'] = $correct_answers_count;
        $result['QUESTION_COUNT'] = $this->questionsCount;

        // Добавляем результат тестирования в базу данных
        (new TestResult())->add([
            'user_intellect' => $this->user->getIntellect(),
            'min_difficult' => $this->minDifficulty,
            'max_difficult' => $this->maxDifficulty,
            'correct_answers_count' => $correct_answers_count,
            'questions_count' => $this->questionsCount,
        ]);

        return $result;
    }

    /**
     * Функция формирует список вопросов для тестирования
     */
    protected function setQuestions()
    {
        // Получаем спиок вопросов из БД
        $questionList = Question::getRandQuestions($this->questionsCount);

        // Проходим по списку полученных вопросов
        foreach ($questionList as $arQuestion) {
            // Из списка вопросов формируем объекты класса Question
            $question = new Question(rand($this->minDifficulty, $this->maxDifficulty), $arQuestion['id'], $arQuestion['shows_count']);
            // Добавляем вопрос в массив вопров для текуего теста
            $this->questions[] = $question;
        }
    }
}