<?php
/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 3/11/16
 * Time: 07:44 AM
 */

namespace Calificaciones\Modelo;


abstract class ModeloBase implements \JsonSerializable
{

    /**
     * @var int|null
     */
    private $id;
    /**
     * @var int
     */
    private $estado;

    function __construct(int $estado = 1, $id = null)
    {
        $this->estado = $estado;
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getEstado(): int
    {
        return $this->estado;
    }

    /**
     * @param int $estado
     */
    public function setEstado(int $estado)
    {
        $this->estado = $estado;
    }

    public function toArray()
    {
        return [
            'estado' => $this->estado,
            'id' => $this->id
        ];
    }

    function jsonSerialize()
    {
        return $this->toArray();
    }

    function __toString()
    {
        return json_encode($this);
    }

}