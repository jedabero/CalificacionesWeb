<?php
/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 14/11/16
 * Time: 08:48 PM
 */

namespace Calificaciones\Modelo\Dominio;


use Calificaciones\Modelo\ModeloBase;
use Calificaciones\Soporte\Coleccion;

class Periodo extends ModeloBase
{

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var int
     */
    private $orden;

    /**
     * @var Grupo
     */
    private $grupo;

    /**
     * @var int|null
     */
    private $grupo_id;

    /**
     * @var Asignatura[]|Coleccion
     */
    private $asignaturas;

    /**
     * @var float
     */
    private $promedio;

    /**
     * @var bool
     */
    private $promedioCalculado = false;

    public static function crear(array $registro): Periodo
    {
        return new static(
            $registro['nombre'],
            $registro['orden'],
            array_key_exists('grupo_id', $registro) ? $registro['grupo_id'] : null,
            array_key_exists('estado', $registro) ? $registro['estado'] : 1,
            array_key_exists('id', $registro) ? $registro['id'] : null
        );
    }

    function __construct(string $nombre, int $orden, $grupo_id, int $estado = 1, $id = null)
    {
        parent::__construct($estado, $id);
        $this->nombre = $nombre;
        $this->orden = $orden;
        $this->grupo_id = $grupo_id;
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
     * @return int
     */
    public function getOrden(): int
    {
        return $this->orden;
    }

    /**
     * @param int $orden
     */
    public function setOrden(int $orden)
    {
        $this->orden = $orden;
    }

    /**
     * @return Grupo
     */
    public function getGrupo(): Grupo
    {
        return $this->grupo;
    }

    /**
     * @param Grupo $grupo
     */
    public function setGrupo(Grupo $grupo)
    {
        if (is_null($this->grupo_id)) {
            $this->grupo_id = $grupo->getId();
            $this->grupo = $grupo;
        } else if ($grupo->getId() === $this->grupo_id) {
            $this->grupo = $grupo;
        } else {
            throw new \InvalidArgumentException("El grupo #{$grupo->getId()} no coincide con #$this->grupo_id");
        }
    }

    /**
     * @return null|string
     */
    public function getGrupoId()
    {
        return $this->grupo_id;
    }

    /**
     * @param int $grupo_id
     */
    public function setGrupoId(int $grupo_id)
    {
        $this->grupo_id = $grupo_id;
    }

    /**
     * @return Asignatura[]|Coleccion
     */
    public function getAsignaturas(): Coleccion
    {
        return $this->asignaturas;
    }

    /**
     * @param Coleccion $asignaturas
     */
    public function setAsignaturas(Coleccion $asignaturas)
    {
        $this->asignaturas = Coleccion::crear($asignaturas);
        $this->promedioCalculado = false;
    }

    /**
     * @return float
     */
    public function getPromedio(): float
    {
        if (!$this->promedioCalculado) {
            $this->calcularPromedio();
        }
        return $this->promedio;
    }

    private function calcularPromedio()
    {
        $asignaturas = count($this->asignaturas);
        if ($asignaturas > 0) {
            $promedio = 0;
            foreach ($this->asignaturas as $asignatura) {
                $promedio += $asignatura->getDefinitiva();
            }
            $this->promedio = $promedio/$asignaturas;
        } else {
            $this->promedio = 0;
        }
        $this->promedioCalculado = true;
    }

    public function toArray($mostrarDerivados = true)
    {
        $datos = [
            'nombre' => $this->nombre,
            'orden' => $this->orden,
            'grupo_id' => $this->grupo_id,
            'asignaturas' => $this->asignaturas
        ];

        if ($mostrarDerivados) {
            $datos['promedio'] = $this->getPromedio();
        }

        return array_merge(parent::toArray(), $datos);
    }

}