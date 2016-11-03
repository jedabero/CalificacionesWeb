<?php
/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 3/11/16
 * Time: 07:35 AM
 */

namespace Calificaciones\Modelo\Dominio;


use Calificaciones\Modelo\ModeloBase;

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

    public static function crear(array $registro): Grupo
    {
        return new static(
            $registro['nombre'],
            $registro['usuario_id'],
            $registro['estado'],
            $registro['id']
        );
    }

    function __construct(string $nombre, string $usuario_id, int $estado = 1, $id = null)
    {
        parent::__construct($estado, $id);
        $this->nombres = $nombre;
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

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'nombre' => $this->nombre
        ]);
    }

}