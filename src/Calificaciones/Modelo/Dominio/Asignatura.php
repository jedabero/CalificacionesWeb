<?php
/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 15/11/16
 * Time: 07:19 AM
 */

namespace Calificaciones\Modelo\Dominio;


use Calificaciones\Modelo\ModeloBase;

class Asignatura extends ModeloBase
{

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var float
     */
    private $definitiva;

    /**
     * @var Periodo
     */
    private $periodo;

    /**
     * @var int|null
     */
    private $periodo_id;

    public static function crear(array $registro): Asignatura
    {
        return new static(
            $registro['nombre'],
            array_key_exists('periodo_id', $registro) ? $registro['periodo_id'] : null,
            array_key_exists('estado', $registro) ? $registro['estado'] : 1,
            array_key_exists('id', $registro) ? $registro['id'] : null
        );
    }

    function __construct(string $nombre, $periodo_id, int $estado = 1, $id = null)
    {
        parent::__construct($estado, $id);
        $this->nombre = $nombre;
        $this->periodo_id = $periodo_id;
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
     * @return float
     */
    public function getDefinitiva(): float
    {
        return $this->definitiva;
    }

    /**
     * @param float $definitiva
     */
    public function setDefinitiva(float $definitiva)
    {
        $this->definitiva = $definitiva;
    }

    /**
     * @return Periodo
     */
    public function getPeriodo(): Periodo
    {
        return $this->periodo;
    }

    /**
     * @param Periodo $periodo
     */
    public function setPeriodo(Periodo $periodo)
    {
        $this->periodo = $periodo;
    }

    /**
     * @return int|null
     */
    public function getPeriodoId()
    {
        return $this->periodo_id;
    }

    /**
     * @param int|null $periodo_id
     */
    public function setPeriodoId($periodo_id)
    {
        $this->periodo_id = $periodo_id;
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'nombre' => $this->nombre,
            'definitiva' => $this->definitiva,
            'periodo_id' => $this->periodo_id
        ]);
    }

}