<?php

namespace Calificaciones\Modelo\Dominio;

/**
 * 
 */
class Usuario
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

    public static function crear(array $registro): Usuario
    {
        return new Usuario(
            $registro['identificacion'],
            $registro['nombres'],
            $registro['apellidos'],
            $registro['email'],
            $registro['usuario'],
            $registro['estado'],
            $registro['id']
        );
    }

    function __construct(string $identificacion, string $nombres, string $apellidos, string $email, string $usuario, int $estado = 1, $id = null)
    {
        $this->identificacion = $identificacion;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->usuario = $usuario;
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


}
