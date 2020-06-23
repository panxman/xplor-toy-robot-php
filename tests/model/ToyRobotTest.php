<?php
use PHPUnit\Framework\TestCase;

class ToyRobotTest extends TestCase {
    /**
     * @covers ToyRobot::__construct
     */
    public function testCreateRobot()
    {
        $robot = new ToyRobot();

        $this->assertEquals(-1, $robot->getX());
        $this->assertEquals(-1, $robot->getY());
        $this->assertEquals("", $robot->getFacing());
        $this->assertFalse($robot->getHasBeenPlaced());

        return $robot;
    }

    /**
     * @covers ToyRobot::placeRobot
     * @depends testCreateRobot
     */
    public function testPlaceRobot(ToyRobot $robot): void
    {
        $robot->placeRobot(0,0,"EAST");

        $this->assertEquals(0, $robot->getX());
        $this->assertEquals(0, $robot->getY());
        $this->assertEquals("EAST", $robot->getFacing());
        $this->assertTrue($robot->getHasBeenPlaced());
    }
    /**
     * @covers ToyRobot::placeRobot
     * @depends testCreateRobot
     */
    public function testWrongCoordinates(ToyRobot $robot): void
    {
        $robot->placeRobot(0,7,"NORTH");
        $this->expectOutputString("Please enter coordinates between 0 - 4\n");
    }

    /**
     * @covers ToyRobot::placeRobot
     * @depends testCreateRobot
     */
    public function testWrongDirection(ToyRobot $robot): void
    {
        $robot->placeRobot(1,2,"test");
        $this->expectOutputString("Please describe the direction of the robot (NORTH, EAST, SOUTH, WEST).\n");
    }

    /**
     * @covers ToyRobot::moveRobot
     */
    public function testRobotWillNotMoveUntilPlaced(): void
    {
        $robot = new ToyRobot();
        $robot->moveRobot();

        $this->expectOutputString("Please place the robot at the table first!\n");
        $this->assertEquals(-1, $robot->getX());
        $this->assertEquals(-1, $robot->getY());
        $this->assertEquals("", $robot->getFacing());
        $this->assertFalse($robot->getHasBeenPlaced());
    }

    /**
     * @covers ToyRobot::placeRobot
     * @covers ToyRobot::moveRobot
     * @depends testCreateRobot
     */
    public function testRobotWillNotFallOffTable(ToyRobot $robot): void 
    {
        $robot->placeRobot(4,2,"EAST");
        $robot->moveRobot();

        $this->expectOutputString("The robot will fall of the table!\n");
        $this->assertEquals(4, $robot->getX());
        $this->assertEquals(2, $robot->getY());
        $this->assertEquals("EAST", $robot->getFacing());
    }

    /**
     * @covers ToyRobot::placeRobot
     * @covers ToyRobot::moveRobot
     * @depends testCreateRobot
     */
    public function testRobotWillMove(ToyRobot $robot): void
    {
        $robot->placeRobot(2,2,"SOUTH");
        $robot->moveRobot();

        $this->assertEquals(2, $robot->getX());
        $this->assertEquals(1, $robot->getY());
        $this->assertEquals("SOUTH", $robot->getFacing());
    }

    /**
     * @covers ToyRobot::placeRobot
     * @covers ToyRobot::turnRobot
     * @depends testCreateRobot
     */
    public function testRobotWillTurnLeft(ToyRobot $robot): void 
    {
        $robot->placeRobot(2,2,"SOUTH");
        $robot->turnRobot("LEFT");
        $this->assertEquals("EAST", $robot->getFacing());
        $robot->turnRobot("LEFT");
        $this->assertEquals("NORTH", $robot->getFacing());
        $robot->turnRobot("LEFT");
        $this->assertEquals("WEST", $robot->getFacing());
        $robot->turnRobot("LEFT");
        $this->assertEquals("SOUTH", $robot->getFacing());
    }

    /**
     * @covers ToyRobot::placeRobot
     * @covers ToyRobot::turnRobot
     * @depends testCreateRobot
     */
    public function testRobotWillTurnRight(ToyRobot $robot): void 
    {
        $robot->placeRobot(2,2,"SOUTH");
        $robot->turnRobot("RIGHT");
        $this->assertEquals("WEST", $robot->getFacing());
        $robot->turnRobot("RIGHT");
        $this->assertEquals("NORTH", $robot->getFacing());
        $robot->turnRobot("RIGHT");
        $this->assertEquals("EAST", $robot->getFacing());
        $robot->turnRobot("RIGHT");
        $this->assertEquals("SOUTH", $robot->getFacing());
    }

    /**
     * @covers ToyRobot::placeRobot
     * @covers ToyRobot::turnRobot
     */
    public function testRobotWillNotTurn(): void 
    {
        $robot = new ToyRobot();
        $robot->turnRobot("LEFT");
        $output = "Please place the robot at the table first!\n";
        $robot->placeRobot(3,3,"WEST");
        $robot->turnRobot("TEST");
        $output .= "Error. Please use either LEFT or RIGHT.\n";
        $this->expectOutputString($output);
    }

    /**
     * @covers ToyRobot::placeRobot
     * @covers ToyRobot::moveRobot
     * @covers ToyRobot::turnRobot
     * @covers ToyRobot::report
     * @depends testCreateRobot
     */
    public function testRobotReport(ToyRobot $robot): void 
    {
        $robot->placeRobot(1,1,"NORTH");
        $robot->moveRobot();
        $robot->turnRobot("RIGHT");
        $robot->moveRobot();
        $robot->report();

        $this->expectOutputString("2,2,EAST\n");
    }

    /**
     * @covers ToyRobot::report
     */
    public function testRobotReportFail(): void 
    {
        $robot = new ToyRobot();
        $robot->report();

        $this->expectOutputString("Please place the robot at the table first!\n");
    }
}
?>
