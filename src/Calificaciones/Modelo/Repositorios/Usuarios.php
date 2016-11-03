<?php
/**
 * Created by PhpStorm.
 * User: jedabero
 * Date: 2/11/16
 * Time: 07:08 PM
 */

namespace Calificaciones\Modelo\Repositorios;


use Calificaciones\Modelo\DbAdaptador;

class Usuarios
{

    /**
     * @var DbAdaptador
     */
    private $adaptador;

    /**
     * @const string
     */
    const TABLA_USUARIOS = "usuarios";

    public function __construct(DbAdaptador $adaptador)
    {
        $this->adaptador = $adaptador;
    }

    /**
     *
     * @return array|null
     */
    public function todos()
    {
        return $this->adaptador->listar(self::TABLA_USUARIOS);
    }

    /**
     * @param int $id
     *
     * @return array|null
     */
    public function buscar(int $id)
    {
        return $this->adaptador->buscarPorId(self::TABLA_USUARIOS, $id);;
    }


    /**
     * @param array $datos
     *
     */
    public function guardar(array $datos)
    {
        if (array_key_exists('id', $datos) && !is_null($datos['id'])) {
            $this->adaptador->actualizar(self::TABLA_USUARIOS, $datos, ['id' => $datos['id']]);
        } else {
            $this->adaptador->guardar(self::TABLA_USUARIOS, $datos);
        }
    }

}