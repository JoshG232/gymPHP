<?php
class Exercise{
    public $name;
    public $reps;
    public $weight;

    public function __construct($name, $reps, $weight)
    {
        $this->name = $name;
        $this->reps = $reps;
        $this->weight = $weight;
    }
    
}

?>