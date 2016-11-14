<?php
/**
 * Created by PhpStorm.
 * User: desya
 * Date: 12.11.2016
 * Time: 20:20
 */

namespace Elevator;


interface IObservable
{
    /**
     * @param IObserver $objObserver
     * @return mixed
     */
    public function addObserver( IObserver $objObserver);

    /**
     * @param $strEventType
     * @return mixed
     */
    public function fireEvent( $strEventType );
}