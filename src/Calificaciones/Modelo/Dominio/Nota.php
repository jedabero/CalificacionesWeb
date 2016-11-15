<?php
/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 15/11/16
 * Time: 01:10 PM
 */

namespace Calificaciones\Modelo\Dominio;


use Calificaciones\Modelo\ModeloBase;

class Nota extends ModeloBase
{

    /**
     * @var float
     */
    private $valor;

    /**
     * @var float
     */
    private $peso;

    /**
     * @var int
     */
    private $orden;

    /**
     * @var Asignatura
     */
    private $asignatura;

    /**
     * @var int|null
     */
    private $asignatura_id;

    public static function crear(array $registro): Nota
    {
        return new static(
            $registro['valor'],
            $registro['peso'],
            $registro['orden'],
            array_key_exists('asignatura_id', $registro) ? $registro['asignatura_id'] : null,
            array_key_exists('estado', $registro) ? $registro['estado'] : 1,
            array_key_exists('id', $registro) ? $registro['id'] : null
        );
    }

    /**
     * Nota constructor.
     * @param float $valor
     * @param float $peso
     * @param int $orden
     */
    public function __construct(float $valor, float $peso, int $orden, $asignatura_id, int $estado = 1, $id = null)
    {
        parent::__construct($estado, $id);
        $this->valor = $valor;
        $this->peso = $peso;
        $this->orden = $orden;
        $this->asignatura_id = $asignatura_id;
    }

    /**
     * @return float
     */
    public function getValor(): float
    {
        return $this->valor;
    }

    /**
     * @param float $valor
     */
    public function setValor(float $valor)
    {
        $this->valor = $valor;
    }

    /**
     * @return float
     */
    public function getPeso(): float
    {
        return $this->peso;
    }

    /**
     * @param float $peso
     */
    public function setPeso(float $peso)
    {
        $this->peso = $peso;
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
     * @return Asignatura
     */
    public function getAsignatura(): Asignatura
    {
        return $this->asignatura;
    }

    /**
     * @param Asignatura $asignatura
     */
    public function setAsignatura(Asignatura $asignatura)
    {
        $this->asignatura = $asignatura;
    }

    /**
     * @return int|null
     */
    public function getAsignaturaId()
    {
        return $this->asignatura_id;
    }

    /**
     * @param int|null $asignatura_id
     */
    public function setAsignaturaId($asignatura_id)
    {
        $this->asignatura_id = $asignatura_id;
    }

    public function valorPonderado(): float
    {
        return $this->peso * $this->valor;
    }

    public function toArray($mostrarDerivados = true)
    {
        $datos = [
            'valor' => $this->valor,
            'peso' => $this->peso,
            'orden' => $this->orden,
            'asignatura_id' => $this->asignatura_id
        ];

        if ($mostrarDerivados) {

        }

        return array_merge(parent::toArray(), $datos);
    }

}