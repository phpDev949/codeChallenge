<?php  
/*
Challenge 2: Implement AnswerInterface and get Question to echo "4".
*/
class Question
{
    public function __construct(AnswerInterface $answer)
    {
        echo "What is 2 + 2?\n";
        $answer = $answer->get()->the()->answer();

        if ($answer instanceof AnswerInterface) {
            echo $answer . PHP_EOL;
        }
    }
}

interface AnswerInterface
{
    public function get();
    public function the();
    public function answer();
}

// start editing here

class Answer implements AnswerInterface{

    private $ans;
    public function __construct(){}
    public function get(){
        $this->ans = 2;
        return $this;
    }
    public function the(){
        $this->ans += 2;
        return $this;
    }
    public function answer(){
        return $this;
    }
    public function __toString() {
        return (string)$this->ans;
    }
}

// end editing here

$answer = new Answer;
$question = new Question($answer);
?>
