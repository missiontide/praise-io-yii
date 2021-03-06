<?php
namespace Codeception\Extension;

use Codeception\Event\TestEvent;
use Codeception\Events;
use Codeception\Extension;
use Codeception\Test\Descriptor;

/**
 * This extension demonstrates how you can implement console output of your own.
 * Recommended to be used for development purposes only.
 */
class SimpleReporter extends Extension
{
    public function _initialize()
    {
        $this->options['silent'] = false; // turn on printing for this extension
        $this->_reconfigure(['settings' => ['silent' => true]]); // turn off printing for everything else
    }

    // we are listening for events
    public static $events = [
        Events::SUITE_BEFORE => 'beforeSuite',
        Events::TEST_END     => 'after',
        Events::TEST_SUCCESS => 'success',
        Events::TEST_FAIL    => 'fail',
        Events::TEST_ERROR   => 'error',
    ];

    public function beforeSuite()
    {
        $this->writeln("");
    }

    public function success()
    {
        $this->write('[+] ');
    }

    public function fail()
    {
        $this->write('[-] ');
    }

    public function error()
    {
        $this->write('[E] ');
    }

    // we are printing test status and time taken
    public function after(TestEvent $e)
    {
        $seconds_input = $e->getTime();
        // stack overflow: https://stackoverflow.com/questions/16825240/how-to-convert-microtime-to-hhmmssuu
        $seconds = (int)($milliseconds = (int)($seconds_input * 1000)) / 1000;
        $time = ($seconds % 60) . (($milliseconds === 0) ? '' : '.' . $milliseconds);

        $this->write(Descriptor::getTestSignature($e->getTest()));
        $this->writeln(' (' . $time . 's)');
    }
}
