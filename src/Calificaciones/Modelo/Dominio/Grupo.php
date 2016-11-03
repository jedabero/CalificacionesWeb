<?php
/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 3/11/16
 * Time: 07:35 AM
 */

namespace Calificaciones\Modelo\Dominio;


class Grupo implements \JsonSerializable
{
    /**
     * @var int|null
     */
    private $id;
    /**
     * @var int
     */
    private $estado;
    /**
     * @var string
     */
    private $nombre;

    public static function crear(array $registro): Grupo
    {
        return new Grupo(
            $registro['nombre'],
            $registro['estado'],
            $registro['id']
        );
    }

    function __construct(string $nombre, int $estado = 1, $id = null)
    {
        $this->nombres = $nombre;
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

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function toArray()
    {
        return [
            'nombre' => $this->nombre,
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