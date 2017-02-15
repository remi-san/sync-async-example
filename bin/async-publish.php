<?php

require __DIR__ . '/../vendor/autoload.php';

use Burrow\Driver\DriverFactory;
use Burrow\LeagueEvent\EnqueueListener;
use Burrow\Publisher\AsyncPublisher;
use Evaneos\Async\MyEventSerializer;
use League\Event\Emitter;
use League\Event\Event;

const MY_EVENT = 'my.event';

// Declaration : all of that can be done in the DI
$emitter = new Emitter();

$driver = DriverFactory::getDriver(['host' => 'default', 'port' => '5672', 'user' => 'guest', 'pwd' => 'guest']);
$publisher = new AsyncPublisher($driver, 'my.events');
$serializer = new MyEventSerializer();

$listener = new EnqueueListener($publisher, $serializer);
$emitter->addListener(MY_EVENT, $listener, Emitter::P_NORMAL);

// Emit the event : your domain action
$emitter->emit(new Event(MY_EVENT));
