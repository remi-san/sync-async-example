<?php

namespace Evaneos\Async;

use League\Event\EventInterface;
use League\Event\ListenerInterface;

class MyEventListener implements ListenerInterface
{
    /**
     * Handle an event.
     *
     * @param EventInterface $event
     *
     * @return void
     */
    public function handle(EventInterface $event)
    {
        echo $event->getName() . PHP_EOL;
    }

    /**
     * Check whether the listener is the given parameter.
     *
     * @param mixed $listener
     *
     * @return bool
     */
    public function isListener($listener)
    {
        return true;
    }
}
