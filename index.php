<?php

ini_set('display_errors' , 1);
ini_set('display_startup_errors' , 1);
error_reporting(E_ALL);

/* What's new in PHP 8 */



/** SWITCH   vs. MATCH
 *
 */
$name = 'Adam';

switch ($name) {
        case 'Robert' :
                $message = 'Hello Robert';
                break;
        case 'John' :
                $message = 'Hello John';
                break;
        case 'Adam' :
                $message = 'Your perfect!';
                break;

        default: $message = 'Hello unknown';
}

$message = match($name) {
        'Robert' => 'Hello Robert',
        'John' => 'Hello John',
        'Adam' => "You're perfect!",
        default => 'Hello unknown'
};

/** Named function/method arguments  */
function person($name , $lastname , $age, $address = null , $bio = null) {
        echo 'Hello' . $name . ' ' . $lastname . ' ' . 'You are' . $age . 'years old.';

        if ($address) echo 'You live in' . $address;
        if ($bio) echo 'You live in' . $bio;
}

// Before PHP 8
person('Kamil' , 'Ferens' , 28, null , 'My bio' );

// From PHP 8
person(name: 'Kamil' , lastname: 'Ferens' , age: 28 , address: 'Wrocław');

/** Constructor Property promotion
 * The parameters so declared will immediately assign values to the variables */
class User2 {
        public function __construct(public string $name , public int $age) {

        }
}

/** Null safe operator */
class User4 {
        public function __construct(public string $name , public int $age) {

        }

        public function address2() {
                // return new Address();
                return null;
        }
}

class Address2 {
        public function country() : string {
                return 'USA' . "\n";
        }
}

$user4 = new User4('Kamil' , 28);
// from PHP 8 - possibility to react to a null value
echo $user4->address2()?->country() ?? 'homeless' . "\n";

/** Union types
 * before PHP 8 - only one optional type can be set
 * from PHP 8 - Several optional types can be set */
class User5 {
        public function foo(string | int | array $arg) : string | int | array {
                return $arg . "\n";
        }
}

/** New possibilities for working on string types */
echo str_contains('Lorem ipsum dolor es' , 'Lorem') . "\n";
echo str_starts_with('Lorem ipsum dolor es' , 'Lorem') . "\n";
echo str_ends_with('Lorem ipsum dolor es' , 'es') . "\n";

/** Primacy of the concatenation operator */
echo "sum: " . 1 + 1 . "\n";   //before PHP8 => sum: 11
echo "sum: " . 1 + 1 . "\n";   //from PHP8     => sum: 2

/** Negative indexes of array */
$a = array_fill(0 , 4 , true);          // before PHP 8
var_dump($a);

$b = array_fill(-5 , 4 , true);         // from PHP 8
var_dump($b);
