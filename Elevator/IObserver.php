<?php

namespace Elevator;


interface IObserver
{
    /**
     * @param IObservable $objSource
     * @param $objArguments
     * @return mixed
     */
    public function notify( IObservable $objSource, $objArguments );
}