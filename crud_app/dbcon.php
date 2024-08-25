<?php

define("HOSTNAME", "localhost");
define("USERNAME", "root"); // MySQL usernames are typically lowercase
define("PASSWORD", ""); // Ensure this is correct for your setup
define("DATABASE", "crud_operations");

$connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error()); // Provide error details
} else {
    echo "";
}
?>