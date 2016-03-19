<?php
/**
 * @file TimersTest.php
 */

namespace Cxj;

/**
 * Class TimersTest
 * @mixin \Cxj\Timers
 */
class TimersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Cxj\Timers
     */
    protected $timer;

    public function setUp()
    {
        $this->timer = new Timers();
    }

    public function testConstructor()
    {
        $t2 = new Timers();
        $this->assertInstanceOf('\Cxj\Timers', $t2);
    }

    public function testStartOk()
    {
        $this->assertEquals(true, $this->timer->start('name1'));
    }


    public function testStopOk()
    {
        $this->timer->start('timer1');
        $this->assertNotEquals(false, $this->timer->stop('timer1'));
    }

    public function testStopFail()
    {
        $this->assertEquals(false, $this->timer->stop('nonexistent'));
    }

    public function testStopHasValue()
    {
        $this->timer->start('timer2');
        usleep(1000);
        $time = 1000 * $this->timer->stop('timer2'); // scale microseconds
        $this->assertNotEquals(false, $time);
        $this->assertGreaterThan(1, $time);
    }

    public function testReadIncreases()
    {
        // read()ing a running timer should always increase in value.
        $timer = 'mytimer3';
        $this->timer->start($timer);
        usleep(1000);
        $r1 = $this->timer->read($timer);
        usleep(1000);
        $r2 = $this->timer->read($timer);

        $this->assertGreaterThan($r1, $r2); // yes, PHPUnit syntax is backward.
    }
}
