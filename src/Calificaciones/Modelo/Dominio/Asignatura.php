<?php
/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 15/11/16
 * Time: 07:19 AM
 */

namespace Calificaciones\Modelo\Dominio;


use Calificaciones\Modelo\ModeloBase;
use Calificaciones\Soporte\Coleccion;

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

    /**
     * @var Nota[]|Coleccion
     */
    private $notas;

    /**
     * @var bool
     */
    private $definitivaCalculada = false;

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
        if (!$this->definitivaCalculada) {
            $this->calcularDefinitiva();
        }
        return $this->definitiva;
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

    /**
     * @return Nota[]|Coleccion
     */
    public function getNotas(): Coleccion
    {
        return $this->notas;
    }

    /**
     * @param Coleccion $notas
     */
    public function setNotas(Coleccion $notas)
    {
        $this->notas = Coleccion::crear($notas);
        $this->definitivaCalculada = false;
    }

    private function calcularDefinitiva()
    {
        if (count($this->notas) > 0) {
            $definitiva = 0;
            $pesoTotal = 0;
            foreach ($this->notas as $nota) {
                $definitiva += $nota->valorPonderado();
                $pesoTotal += $nota->getPeso();
            }
            $this->definitiva = $definitiva/$pesoTotal;
        } else {
            $this->definitiva = 0;
        }
        $this->definitivaCalculada = true;
    }

    public function toArray($mostrarDerivados = true)
    {
        $datos = [
            'nombre' => $this->nombre,
            'periodo_id' => $this->periodo_id,
            'notas' => $this->notas
        ];

        if ($mostrarDerivados) {
            $datos['definitiva'] = $this->getDefinitiva();
        }

        return array_merge(parent::toArray(), $datos);
    }

}