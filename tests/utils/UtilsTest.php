<?php
use PHPUnit\Framework\TestCase;

/**
 * Tests the utils.php file.
 * Will not be very detailed here, because ToyRobot has been thoroughly tested.
 */
class UtilsTest extends TestCase {
    protected $robot;
    /**
     * Set Up
     */
    function setUp(): void 
    {
        $this->robot = new ToyRobot();
        $this->robot->placeRobot(0,0,"EAST");
    }

    /**
     * @covers Utils::parseCommand
     * @covers ToyRobot::placeRobot
     */
    public function testPlaceCommand(): void 
    {
        Utils::parseCommand($this->robot, "PLACE 1,2,NORTH");

        $this->assertEquals(1, $this->robot->getX());
        $this->assertEquals(2, $this->robot->getY());
        $this->assertEquals("NORTH", $this->robot->getFacing());
    }

    /**
     * @covers Utils::parseCommand
     * @covers ToyRobot::moveRobot
     */
    public function testMoveCommand(): void 
    {
        Utils::parseCommand($this->robot, "MOVE");

        $this->assertEquals(1, $this->robot->getX());
        $this->assertEquals(0, $this->robot->getY());
        $this->assertEquals("EAST", $this->robot->getFacing());
    }

    /**
     * @covers Utils::parseCommand
     * @covers ToyRobot::turnRobot
     */
    public function testLeftCommand(): void 
    {
        Utils::parseCommand($this->robot, "LEFT");

        $this->assertEquals(0, $this->robot->getX());
        $this->assertEquals(0, $this->robot->getY());
        $this->assertEquals("NORTH", $this->robot->getFacing());
    }

    /**
     * @covers Utils::parseCommand
     * @covers ToyRobot::turnRobot
     */
    public function testRightCommand(): void 
    {
        Utils::parseCommand($this->robot, "RIGHT");
    
        $this->assertEquals(0, $this->robot->getX());
        $this->assertEquals(0, $this->robot->getY());
        $this->assertEquals("SOUTH", $this->robot->getFacing());
    }

    /**
     * @covers Utils::parseCommand
     * @covers ToyRobot::moveRobot
     * @covers ToyRobot::turnRobot
     * @covers ToyRobot::report
     */
    public function testReportCommand(): void 
    {
        Utils::parseCommand($this->robot, "MOVE");
        Utils::parseCommand($this->robot, "move");
        Utils::parseCommand($this->robot, "Left");
        Utils::parseCommand($this->robot, "movE");
        Utils::parseCommand($this->robot, "rEpoRt");

        $this->expectOutputString("2,1,NORTH\n");
    }

    /**
     * @covers Utils::parseCommand
     */
    public function testBadCommands(): void 
    {
        Utils::parseCommand($this->robot, "MOV");
        Utils::parseCommand($this->robot, "let");
        Utils::parseCommand($this->robot, "rightT");
        Utils::parseCommand($this->robot, "test");
        
        $this->assertEquals(0, $this->robot->getX());
        $this->assertEquals(0, $this->robot->getY());
        $this->assertEquals("EAST", $this->robot->getFacing());
        $this->expectOutputString("");
    }
}

?>
