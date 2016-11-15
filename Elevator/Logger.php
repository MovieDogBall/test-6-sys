<?php

namespace Elevator;

class Logger implements IObserver
{
    private $separator = "<br />";

    /**
     * @param IObservable $objSource
     * @param $objArguments
     * @return mixed
     */
    public function notify(IObservable $objSource, $objArguments)
    {
        if($objArguments == 'movedTo'){
            printf( 'Elevator moved to: %s at floor: %s.'.$this->separator,
                $objSource->getDirection(), $objSource->getCurrentFloor());
        }elseif($objArguments == 'stayOn'){
            printf( 'Elevator stopped at floor: %s.'.$this->separator,
                $objSource->getCurrentFloor());
        }else{
            print_r($objArguments.$this->separator);
        }
    }
}