<?php

/* Utilities class with helpful functions */
class Utils {

    // Parse each command and call the Robot methods
    static function parseCommand($robot, $line) {
        // Break the Line into:
        // [0]: COMMAND
        // [1]: PARAMETERS (if applicable)
        $commands = explode(" ", $line);
        
        switch (strtoupper($commands[0])) {
            case "PLACE":
                if (count($commands) === 2) {
                    // Separate Parameters into:
                    // [0]: X
                    // [1]: Y
                    // [2]: Direction
                    $coords = explode(",", $commands[1]);
                    if (count($coords) === 3) {
                        $robot->placeRobot($coords[0], $coords[1], $coords[2]);
                    }
                }
                break;
            case "MOVE":
                $robot->moveRobot();
                break;
            case "LEFT":
                $robot->turnRobot("LEFT");
                break;
            case "RIGHT":
                $robot->turnRobot("RIGHT");
                break;
            case "REPORT":
                $robot->report();
                break;
            default:
                print "";
        }
    }
    
}

?>
