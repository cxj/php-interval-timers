<?php
/**
 * Simple interval timers.
 */

namespace Cxj;

/**
 * Class Timers
 *
 * Class provides multiple, named microsecond interval timers.  A typical
 * usage would be to time elapsed execution time over a section of code or
 * time the transaction time to a database or other network server.
 *
 * A conscious decision was made to provide multiple, named timers in one
 * class rather than have a caller instantiate multiple single-time objects,
 * on the theory that code critical enough to be instrumented with multiple
 * timers probably would not also want to have a small swarm of extra objects
 * floating around.  There were no concrete statistics used to prove that this
 * was a better idea, however.
 */
class Timers
{
    /**
     * @var array - list of timers and their effective start times.
     */
    protected $timerList = array();

    /**
     * @var array - list of accumulated time for timers.
     */
    protected $accumulators = array();

    /**
     * Constructor.
     */
    public function __construct()
    {
    }

    /**
     * Starts a new timer (if name does not exist), otherwise restarts a
     * previously paused timer.
     *
     * @param $name
     *
     * @return bool
     */
    public function start($name)
    {
        if (!isset($this->timerList[$name])) {
            // new timer, insure accumulator is zero.
            $this->accumulators[$name] = 0.0;
        }

        $this->timerList[$name] = microtime(true) - $this->accumulators[$name];

        return true;
    }

    /**
     * Stop a running timer.
     * @param $name
     *
     * @return bool|mixed - false on failure, floating seconds on success.
     */
    public function stop($name)
    {
        if (!isset($this->timerList[$name])) return false;

        $this->accumulators[$name] = microtime(true) - $this->timerList[$name];

        return $this->accumulators[$name];
    }

    /**
     * Return current value of a timer.
     * @param $name - name of the timer.
     *
     */
    public function read($name)
    {
        if (!isset($this->timerList[$name])) return false;

        return microtime(true) - $this->timerList[$name];
    }

    /**
     * Reset an existing timer to zero.
     * @param $name - name of the timer.
     *
     * @return bool - true on success, false if no such named timer existed.
     */
    public function reset($name)
    {
        if (!isset($this->timerList[$name])) return false;

        $this->accumulators[$name] = 0.0;
        $this->timerList[$name] = 0.0;

        return true;
    }
}
