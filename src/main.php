<?php
include 'Entity/ToyRobot.php';
include 'utils/utils.php';

// The path to the Commands file
const FILENAME = __DIR__ . DIRECTORY_SEPARATOR . "commands.txt";

// Create a new Toy Robot
$robot = new ToyRobot();

/* User Interaction */

// File or Command Line?
$inputMethod = "";
while ($inputMethod !== "CLI" && $inputMethod !== "FILE") {
    $inputMethod = readline("How do you want to command the robot? ('cli' or 'file'): ");
    $inputMethod = strtoupper($inputMethod);
}

// File
if ($inputMethod === "FILE") {
    print "Using src/commands.txt to read the commands!\n";

    // Open File
    $myFile = fopen(FILENAME, "r") or die("Unable to find this file!");

    // Read Lines
    while (!feof($myFile)) {
        $line = fgets($myFile);
        $line = trim($line);

        // Run each command
        parseCommand($robot, $line);
    }

    // Close File
    fclose($myFile);
}

// Command Line
if ($inputMethod === "CLI") {
    print "Using the command line to read the commands.\n";

    $userInput = "";

    while ($userInput !== "EXIT") {
        $userInput = readline("Command: ('exit' to stop): ");
        $userInput = strtoupper($userInput);

        if ($userInput !== "EXIT") {
            parseCommand($robot, $userInput);
        }
    }
}

?>
