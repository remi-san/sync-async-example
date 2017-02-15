<?php

namespace Evaneos\Async;

use Burrow\LeagueEvent\EventDeserializer;
use Burrow\LeagueEvent\EventSerializer;
use Burrow\Serializer\DeserializeException;
use League\Event\Event;
use League\Event\EventInterface;

class MyEventSerializer implements EventSerializer, EventDeserializer
{
    /**
     * @param  EventInterface $event
     *
     * @return string
     */
    public function serialize(EventInterface $event)
    {
        return $event->getName();
    }

    /**
     * @param  string $message
     *
     * @return EventInterface
     *
     * @throws DeserializeException
     */
    public function deserialize($message)
    {
        return new Event($message);
    }
}
