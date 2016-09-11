<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace TripleI\Timer;

class Timer {
    private static $instance;

    protected $start;
    protected $prev;
    protected $level = 0;

    const LEVEL_DEBUG = 0;
    const LEVEL_HIDDEN = 10;
    const LEVEL_DISABLED = 20;

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    protected function __construct()
    {
        $this->start = microtime(true);
        $this->prev = $this->start;
    }

    public static function setLevel($level)
    {
        $instance = static::getInstance();
        $instance->level = $level;
    }

    public static function tick($label, $since_prev = false)
    {
        $instance = Timer::getInstance();
        $now = microtime(true);
        if ($instance->level == static::LEVEL_DISABLED) {
            return;
        }
        if ($instance->level == static::LEVEL_HIDDEN) {
            print "<!--";
        }
        if ($since_prev) {
            print sprintf("%s - (%s) %s <br />\n", $now - $instance->start, $now - $instance->prev, $label);
        } else {
            print sprintf("%s - %s <br />\n", $now - $instance->start, $label);
        }
        if ($instance->level == static::LEVEL_HIDDEN) {
            print "-->";
        }
        $instance->prev = $now;
    }

    public static function done()
    {
        Timer::tick('Done');
    }

    public static function start()
    {
        Timer::getInstance();
    }
}