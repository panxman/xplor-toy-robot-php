<?php
// The table is 5x5
const WIDTH = 5;
const HEIGHT = 5;

/* The Toy Robot Class. */
class ToyRobot {
    // Parameters for the position of the robot
    private $x;
    private $y;
    private $facing;
    private $hasBeenPlaced;
    
    /* Constructor */
    function __construct() {
        $this->x = -1;
        $this->y = -1;
        $this->facing = "";
        $this->hasBeenPlaced = false;
    }

    /* Deconstructor */
    function __destruct() {
        // print "The robot is being shut down!";
    }

    /* Getters for the testing */
    function getX() {
        return $this->x;
    }
    function getY() {
        return $this->y;
    }
    function getFacing() {
        return $this->facing;
    }
    function getHasBeenPlaced() {
        return $this->hasBeenPlaced;
    }

    /* Place the Robot onto the tabletop */
    function placeRobot($x, $y, $facing) {
        // Make sure 'facing' is Uppercase
        $facing = strtoupper($facing);

        // Check for wrong input
        if ($x < 0 || $x >= WIDTH || $y < 0 || $y >= HEIGHT) {
            print "Please enter coordinates between 0 - 4\n";
        }
        elseif ($facing !== "NORTH" && $facing !== "EAST" && $facing !== "SOUTH" && $facing !== "WEST") {
            print "Please describe the direction of the robot (NORTH, EAST, SOUTH, WEST).\n";
        }
        else {
            $this->x = $x;
            $this->y = $y;
            $this->facing = $facing;
            $this->hasBeenPlaced = true;
        }
    }

    /* Move the robot */
    function moveRobot() {
        if ($this->hasBeenPlaced) {
            // temp x and y to check the movement
            $x = $this->x;
            $y = $this->y;
            switch ($this->facing) {
                case "NORTH":
                    $y += 1;
                    break;
                case "SOUTH":
                    $y -= 1;
                    break;
                case "EAST":
                    $x += 1;
                    break;
                case "WEST":
                    $x -= 1;
                    break;
            }
            // Check if the robot will fall off
            if ($x < 0 || $x >= WIDTH || $y < 0 || $y >= HEIGHT) {
                print "The robot will fall of the table!\n";
            } else {
                $this->x = $x;
                $this->y = $y;
            }
        } else {
            print "Please place the robot at the table first!\n";
        }
    }

    /* Turn the Robot LEFT or RIGHT */
    function turnRobot($direction) {
        if ($this->hasBeenPlaced) {
            switch($direction) {
                case "LEFT":
                    if ($this->facing === "NORTH") $this->facing = "WEST";
                    elseif ($this->facing === "WEST") $this->facing = "SOUTH";
                    elseif ($this->facing === "SOUTH") $this->facing = "EAST";
                    else $this->facing = "NORTH";
                    break;
                case "RIGHT":
                    if ($this->facing === "NORTH") $this->facing = "EAST";
                    elseif ($this->facing === "EAST") $this->facing = "SOUTH";
                    elseif ($this->facing === "SOUTH") $this->facing = "WEST";
                    else $this->facing = "NORTH";
                    break;
                default:
                    print "Error. Please use either LEFT or RIGHT.\n";
            }
        } else {
            print "Please place the robot at the table first!\n";
        }
    }

    /* Get the Robot's Report */
    function report() {
        if ($this->hasBeenPlaced) {
            print "$this->x,$this->y,$this->facing\n";
        } else {
            print "Please place the robot at the table first!\n";
        }
    }
}
?>
