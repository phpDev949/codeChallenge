<?php
/*
Challenge 3: Use reflection to get access to Question::$answer from $e->getAnswer
*/
class Question
{
        private $answer = 42;
        public function __construct($e)
        {
                try {
                        throw $e;
                } catch (Exception $e) {
                        echo $e->getAnswer($this) . PHP_EOL;
                }
        }
}
// start editing here
class AnswerFromException extends Exception
{
        public function getAnswer(Question $q)
        {
                $objQ_R = new ReflectionObject($q);
                $a_Q_R = $objQ_R->getProperty('answer');
                $a_Q_R = $objQ_R->getProperty('answer');
                $a_Q_R->setAccessible(true);
                echo $a_Q_R->getValue($q);
        }
}

$e = new AnswerFromException();
// end editing here
new Question($e);
?>
