<?php

namespace Calificaciones\Modelo\Dominio;
use Calificaciones\Modelo\ModeloBase;
use Calificaciones\Soporte\Coleccion;

/**
 * 
 */
class Usuario extends ModeloBase
{
    /**
     * @var string
     */
    private $identificacion;
    /**
     * @var string
     */
    private $nombres;
    /**
     * @var string
     */
    private $apellidos;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $usuario;
    /**
     * @var string
     */
    private $contrasena;
    /**
     * @var Coleccion
     */
    private $grupos;

    public static function crear(array $registro): Usuario
    {
        return new Usuario(
            $registro['identificacion'],
            $registro['nombres'],
            $registro['apellidos'],
            $registro['email'],
            $registro['usuario'],
            $registro['contrasena'],
            array_key_exists('estado', $registro) ? $registro['estado'] : 1,
            array_key_exists('id', $registro) ? $registro['id'] : null
        );
    }

    function __construct(string $identificacion, string $nombres, string $apellidos, string $email, string $usuario, string $contrasena, int $estado = 1, $id = null)
    {
        parent::__construct($estado, $id);
        $this->identificacion = $identificacion;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->usuario = $usuario;
        $this->contrasena = $contrasena;

        $this->grupos = Coleccion::crear();
    }

    /**
     * @return string
     */
    public function getIdentificacion(): string
    {
        return $this->identificacion;
    }

    /**
     * @param string $identificacion
     */
    public function setIdentificacion(string $identificacion)
    {
        $this->identificacion = $identificacion;
    }

    /**
     * @return string
     */
    public function getNombres(): string
    {
        return $this->nombres;
    }

    /**
     * @param string $nombres
     */
    public function setNombres(string $nombres)
    {
        $this->nombres = $nombres;
    }

    /**
     * @return string
     */
    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    /**
     * @param string $apellidos
     */
    public function setApellidos(string $apellidos)
    {
        $this->apellidos = $apellidos;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getUsuario(): string
    {
        return $this->usuario;
    }

    /**
     * @param string $usuario
     */
    public function setUsuario(string $usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return string
     */
    public function getContrasena(): string
    {
        return $this->contrasena;
    }

    /**
     * @param string $contrasena
     */
    public function setContrasena(string $contrasena)
    {
        $this->contrasena = $contrasena;
    }

    /**
     *
     */
    public function unsetContrasena()
    {
        unset($this->contrasena);
    }

    /**
     * @return Coleccion
     */
    public function getGrupos(): Coleccion
    {
        return $this->grupos;
    }

    /**
     * @param array|Coleccion $grupos
     */
    public function setGrupos($grupos)
    {
        $this->grupos = Coleccion::crear($grupos);
    }

    public function estaGuardado(): boolean
    {
        return is_null($this->getId());
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'identificacion' => $this->identificacion,
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'email' => $this->email,
            'usuario' => $this->usuario,
            'contrasena' => $this->contrasena,
            'grupos' => $this->getGrupos()
        ]);
    }
}
