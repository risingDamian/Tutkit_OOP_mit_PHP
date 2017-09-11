<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 06.09.17
 * Time: 15:11
 */
namespace Alarm;

interface AlarmDispatcher {
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notify();
}
class System implements AlarmDispatcher {
    private $_alertMsg = "";
    private $_observers = array();

    public function triggerAlert(string $msg) {
        $this->_alertMsg = $msg;
        $this->notify();
    }

    public function getAlert() {
        return $this->_alertMsg;
    }

    public function attach(Observer $observer)
    {
        $this->_observers[] = $observer;
    }

    public function detach(Observer $observer)
    {
        foreach ($this->_observers as $index => $currentObserver) {
            if ($observer == $currentObserver) {
                unset($this->_observers[$index]);
            }
        }
    }

    public function notify()
    {
        foreach ($this->_observers as $observer) {
            $observer->update($this);
        }
    }
}