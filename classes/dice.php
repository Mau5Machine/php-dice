<?php
class Dice
{
    private $face_value; // A number from 1 to 6
    private $num_sides; // How many sides does the dice have?
    public $score; // Keep track of a dice score

    // Dice will always start off at 6
    // Constructor function get called EVERY TIME you create a new object
    function __construct($n = 6)
    {
        $this->face_value = $n;
        $this->num_sides = $n;
    }

    function setSides($num_sides)
    {
        $this->num_sides = intval($num_sides);
    }

    function getSides()
    {
        return $this->num_sides;
    }
    // Function to roll the dice
    function roll()
    {
        $this->face_value = rand(1, $this->num_sides); // Set face value to random number
    }

    // Return the face value (i.e. the number facing up)
    function get_face_value()
    {
        return $this->face_value;
    }
}

// The default number of sides is 6 for each dice made
?>