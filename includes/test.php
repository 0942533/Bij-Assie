<?php
// require the Faker autoloader
require_once 'faker/src/autoload.php';

$con = mysqli_connect('localhost','root','', 'test')
or die ('Error: '.mysqli_connect_error());

// use the factory to create a Faker\Generator instance
$faker = Faker\Factory::create();

$con->query("DELETE FROM test");

// create 10 random names
for ($i=0; $i < 10; $i++) {
    $sql = "INSERT INTO test (reserveringsnaam, email) VALUES ('{$faker->name}','{$faker->email}')";

    mysqli_query($con, $sql);
}
?>