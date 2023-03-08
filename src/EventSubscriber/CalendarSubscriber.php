<?php

namespace App\EventSubscriber;

use App\Repository\RendezvousRepository;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use DateTime;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    private $rendezvousRepository;
    private $router;

    public function __construct(RendezvousRepository $rendezvousRepository, UrlGeneratorInterface $router) 
    {
        $this->rendezvousRepository = $rendezvousRepository;
        $this->router = $router;
    }

    public static function getSubscribedEvents()
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar)
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $now = new DateTime();
        $filters = $calendar->getFilters();

        $rendezvousList = $this->rendezvousRepository
            ->createQueryBuilder('r')
            ->where('r.daterv > :now')
            ->setParameter('now', $now)
            ->andWhere('r.daterv BETWEEN :start and :end OR r.endAt BETWEEN :start and :end')
            ->setParameter('start', $start->format('Y-m-d H:i:s'))
            ->setParameter('end', $end->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult()
        ;

        foreach ($rendezvousList as $rendezvous) {
            // this create the events with your data (here rendezvous data) to fill calendar
            $rendezvousEvent = new Event(
                'Rendez-Vous en ' . $rendezvous->getSalle(),
                $rendezvous->getDaterv(),
                $rendezvous->getEndAt() // If the end date is null or not defined, a all day event is created.
            );

            /*
             * Add custom options to events
             *
             * For more information see: https://fullcalendar.io/docs/event-object
             * and: https://github.com/fullcalendar/fullcalendar/blob/master/src/core/options.ts
             */
            $rendezvousEvent->setOptions([
                'backgroundColor' => 'red',
                'borderColor' => 'red',
            ]);
            $rendezvousEvent->addOption(
                'url',
                $this->router->generate('back_rendezvous_index')
            );

            // finally, add the event to the CalendarEvent to fill the calendar
            $calendar->addEvent($rendezvousEvent);
        }
    }
}