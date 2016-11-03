<?php
/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 3/11/16
 * Time: 08:27 AM
 */

namespace Calificaciones\Soporte;


class Coleccion implements \IteratorAggregate, \ArrayAccess, \Countable, \JsonSerializable
{

    private $elementos = [];

    /**
     * Coleccion constructor.
     * @param array $elementos
     */
    public function __construct(array $elementos = [])
    {
        $this->elementos = $elementos;
    }

    /**
     * @param mixed $elementos
     * @return Coleccion
     */
    public static function crear($elementos = null): Coleccion
    {
        if (is_null($elementos)) return new static();
        if ($elementos instanceof Coleccion) return $elementos;
        return new static(is_array($elementos) ? $elementos : [$elementos]);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->elementos);
    }

    public function offsetExists($offset)
    {
        return isset($this->elementos[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->elementos[$offset]) ? $this->elementos[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->elementos[] = $value;
        } else {
            $this->elementos[$offset] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->elementos[$offset]);
    }

    public function count()
    {
        return count($this->elementos);
    }

    public function push($elemento)
    {
        $this->elementos[] = $elemento;
        return $this;
    }

    public function get($index)
    {
        if (array_key_exists($index, $this->elementos)) {
            return $this->elementos[$index];
        }
        throw new \OutOfBoundsException();
    }

    function jsonSerialize()
    {
        return $this->elementos;
    }

}