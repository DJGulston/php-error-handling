<?php

// Custom exception that is thrown when a given number is not positive.
class NotPositiveException extends Exception {
    private $number;

    public function __construct($message, $number) {
        parent::__construct($message);
        $this->number = $number;
    }

    public function get_number() {
        return $this->number;
    }
}

// Custom exception that is thrown when a given number is not divisible by 5.
class NotDivisibleException extends Exception {
    private $number;

    public function __construct($message, $number) {
        parent::__construct($message);
        $this->number = $number;
    }

    public function get_number() {
        return $this->number;
    }
}

// Custom exception that is thrown when a given number is less than 4 digits long.
class NotEnoughDigitsException extends Exception {
    private $number;

    public function __construct($message, $number) {
        parent::__construct($message);
        $this->number = $number;
    }

    public function get_number() {
        return $this->number;
    }
}

// Throws an exception if a number is not positive.
function is_positive($number) {
    if($number < 0) {
        throw new NotPositiveException('Number is not positive.', $number);
    }
}

// Throws an exception if a number is not divisible by 5.
function is_divisible($number) {
    if($number % 5 !== 0) {
        throw new NotDivisibleException('Number is not divisible by 5.', $number);
    }
}

// Throws an exception if a number has less than 4 digits.
function is_enough_digits($number) {
    $str_number = (string) $number;

    if(strlen($str_number) < 4) {
        throw new NotEnoughDigitsException('Number is less than 4 digits long.', $number);
    }
}

echo '<h1>Maths Page:</h1>';

if(isset($_POST['num'])) {

    // Retrieves number from POST request and casts it to an integer.
    $number = (int) $_POST['num'];

    try {
        // Checks if the number fits the 3 criteria - not positive, not divisible
        // by 5 and less than 4 digits long.
        is_positive($number);
        is_divisible($number);
        is_enough_digits($number);
    }
    catch(NotPositiveException $e) {
        // Exception caught if number is not positive.
        echo '<p>' . $e->getMessage() . '<br>Input: ' . $e->get_number() . '</p>';
    }
    catch(NotDivisibleException $e) {
        // Exception caught if number is not divisible by 5.
        echo '<p>' . $e->getMessage() . '<br>Input: ' . $e->get_number() . '</p>';
    }
    catch(NotEnoughDigitsException $e) {
        // Exception caught if number is less than 4 digits long.
        echo '<p>' . $e->getMessage() . '<br>Input: ' . $e->get_number() . '</p>';
    }

}
else {
    // Error message printed if there is no number retrieved from the POST request.
    echo '<p style="color:red;font-weight:bold">No number given!</p>';
}

?>