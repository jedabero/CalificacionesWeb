<?php
/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 3/11/16
 * Time: 07:35 AM
 */

namespace Calificaciones\Modelo\Dominio;


use Calificaciones\Modelo\Modelo;

class Grupo extends Modelo
{
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
        parent::__construct($estado, $id);
        $this->nombres = $nombre;
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
        return array_merge(parent::toArray(), [
            'nombre' => $this->nombre
        ]);
    }

}