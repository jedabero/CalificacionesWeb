<?php
/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 3/11/16
 * Time: 07:35 AM
 */

namespace Calificaciones\Modelo\Dominio;


use Calificaciones\Modelo\ModeloBase;
use Calificaciones\Soporte\Coleccion;

class Grupo extends ModeloBase
{
    /**
     * @var string
     */
    private $nombre;

    /**
     * @var Usuario
     */
    private $usuario;

    /**
     * @var string|null
     */
    private $usuario_id;

    /**
     * @var Periodo[]|Coleccion
     */
    private $periodos;

    public static function crear(array $registro): Grupo
    {
        return new static(
            $registro['nombre'],
            array_key_exists('usuario_id', $registro) ? $registro['usuario_id'] : null,
            array_key_exists('estado', $registro) ? $registro['estado'] : 1,
            array_key_exists('id', $registro) ? $registro['id'] : null
        );
    }

    function __construct(string $nombre, $usuario_id, int $estado = 1, $id = null)
    {
        parent::__construct($estado, $id);
        $this->nombre = $nombre;
        $this->usuario_id = $usuario_id;
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

    /**
     * @return Usuario
     */
    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    /**
     * @param Usuario $usuario
     */
    public function setUsuario(Usuario $usuario)
    {
        if (is_null($this->usuario_id)) {
            $this->usuario_id = $usuario->getId();
            $this->usuario = $usuario;
        } else if ($usuario->getId() === $this->usuario_id) {
            $this->usuario = $usuario;
        } else {
            throw new \InvalidArgumentException("El usuario #{$usuario->getId()} no coincide con #$this->usuario_id");
        }
    }

    /**
     * @return null|string
     */
    public function getUsuarioId()
    {
        return $this->usuario_id;
    }

    /**
     * @return Periodo[]|Coleccion
     */
    public function getPeriodos(): Coleccion
    {
        return $this->periodos;
    }

    /**
     * @param array|Coleccion $periodos
     */
    public function setPeriodos($periodos)
    {
        $this->periodos = Coleccion::crear($periodos);
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'nombre' => $this->nombre,
            'usuario_id' => $this->usuario_id,
            'periodos' => $this->periodos
        ]);
    }

}