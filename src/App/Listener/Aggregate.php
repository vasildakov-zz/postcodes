<?php

namespace App\Listener;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventInterface;

class Aggregate implements ListenerAggregateInterface
{
    protected $listeners = array();

    public function __construct()
    {
        //
    }

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach('do', array($this, 'doSomething'), 100);
        $this->listeners[] = $events->attach('get.pre', array($this, 'load'), 100);
        $this->listeners[] = $events->attach('get.post', array($this, 'save'), -100);
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function doSomething(EventInterface $e)
    {
        exit('doSomething');
    }

    public function load(EventInterface $e)
    {
        exit('load');
    }

    public function save(EventInterface $e)
    {
        exit('save');
    }
}