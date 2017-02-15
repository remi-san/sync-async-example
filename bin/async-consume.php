<?php

require __DIR__ . '/../vendor/autoload.php';

use Burrow\Daemon\QueueHandlingDaemon;
use Burrow\Driver\DriverFactory;
use Burrow\Handler\HandlerBuilder;
use Burrow\LeagueEvent\EventQueueConsumer;
use Evaneos\Async\MyEventListener;
use Evaneos\Async\MyEventSerializer;
use Evaneos\Daemon\Worker;
use League\Event\Emitter;

const MY_EVENT = 'my.event';

// Declarations : all of that can be done in the DI
$emitter = new Emitter();
$listener = new MyEventListener();
$emitter->addListener(MY_EVENT, $listener, Emitter::P_NORMAL);

$deserializer = new MyEventSerializer();
$driver = DriverFactory::getDriver(['host' => 'default', 'port' => '5672', 'user' => 'guest', 'pwd' => 'guest']);
$handlerBuilder = new HandlerBuilder($driver);

$handler = $handlerBuilder->async()->build(new EventQueueConsumer($emitter, $deserializer));

$daemon = new QueueHandlingDaemon($driver, $handler, 'my.events.echo');
$worker = new Worker($daemon);

// Launch the worker
$worker->run();
