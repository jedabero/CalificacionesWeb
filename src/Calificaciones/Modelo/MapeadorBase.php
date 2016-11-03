<?php
/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 3/11/16
 * Time: 08:01 AM
 */

namespace Calificaciones\Modelo;


abstract class MapeadorBase
{
    /**
     * @var DbAdaptador
     */
    private $adaptador;

    function __construct(DbAdaptador $adaptador)
    {
        $this->adaptador = $adaptador;
    }

    /**
     * @return DbAdaptador
     */
    public function getAdaptador(): DbAdaptador
    {
        return $this->adaptador;
    }
}