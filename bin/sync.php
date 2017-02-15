<?php

require __DIR__ . '/../vendor/autoload.php';

use Evaneos\Async\MyEventListener;
use League\Event\Emitter;
use League\Event\Event;

const MY_EVENT = 'my.event';

// Declaration : all of that can be done in the DI
$emitter = new Emitter();
$listener = new MyEventListener();
$emitter->addListener(MY_EVENT, $listener, Emitter::P_NORMAL);

// Emit the event : your domain action
$emitter->emit(new Event(MY_EVENT));
