<?php

namespace Calificaciones\Modelo\Mapeadores;

use Calificaciones\Modelo\Dominio\Usuario as ModeloUsuario;
use Calificaciones\Modelo\MapeadorBase;
use Calificaciones\Modelo\Mapeadores\Grupo as MapeadorGrupo;
use Calificaciones\Soporte\Coleccion;

/**
 * 
 */
class Usuario extends MapeadorBase
{
    /**
     * @const string
     */
    const TABLA = "usuarios";

    /**
     * @param boolean $cargarGrupos
     *
     * @return Coleccion|null
     */
    public function todos($cargarGrupos = true)
    {
        $registros = $this->getAdaptador()->listar(self::TABLA);

        if ($registros == null) {
            throw new \InvalidArgumentException("No existen Usuarios");
        }

        $mapeador = null;
        if ($cargarGrupos) {
            $mapeador = new MapeadorGrupo($this->getAdaptador());
        }

        $todos = Coleccion::crear();
        foreach ($registros as $registro) { //TODO: optimizar; cargar todos los grupos de los usuarios y luego relacionar
            $usuario = $this->mapea($registro);
            if ($cargarGrupos) {
                $usuario->setGrupos($mapeador->todos($usuario->getId()));
            }
            $todos[] = $usuario;
        }
        return $todos;
    }

    /**
     * @param mixed $id
     * @param boolean $cargarGrupos
     *
     * @return ModeloUsuario
     */
    public function buscar($id, $cargarGrupos = true): ModeloUsuario
    {
        $registro = $this->getAdaptador()->buscarPorId(self::TABLA, $id);

        if ($registro == null) {
            throw new \InvalidArgumentException("Usuario #$id no existe");
        }

        $usuario = $this->mapea($registro);

        if ($cargarGrupos) {
            $mapeador = new MapeadorGrupo($this->getAdaptador());
            $usuario->setGrupos($mapeador->todos($id));
        }

        return $usuario;
    }

    /**
     * @param string $usuario
     * @param string $contrasena
     *
     * @return ModeloUsuario
     */
    public function buscarUsuario($usuario, $contrasena): ModeloUsuario
    {
        $contrasena = hash('sha512', $usuario.$contrasena);
        $condiciones = [ 'usuario' => $usuario, 'contrasena' => $contrasena];
        $registro = $this->getAdaptador()->buscar(self::TABLA, $condiciones);

        if ($registro == null) {
            throw new \InvalidArgumentException("Usuario #$usuario no existe");
        }

        return $this->mapea($registro);
    }

    /**
     * @param ModeloUsuario $usuario
     *
     */
    public function guardar(ModeloUsuario $usuario)
    {
        $datos = $usuario->toArray(true);
        $contrasena = hash('sha512', $datos['usuario'].$datos['contrasena']);
        unset($datos['grupos']);
        if (is_null($usuario->getId())) {
            $datos['contrasena'] = $contrasena;
            $id = $this->getAdaptador()->guardar(self::TABLA, $datos);
            $usuario->setId($id);
        } else {
            unset($datos['contrasena']);
            // $usuarioActual = $this->buscar($usuario->getId(), false);
            // TODO: validar
            $this->getAdaptador()->actualizar(self::TABLA, $datos, ['id' => $usuario->getId()]);
        }
    }

    function mapea(array $registro): ModeloUsuario
    {
        return ModeloUsuario::crear($registro);
    }
}
