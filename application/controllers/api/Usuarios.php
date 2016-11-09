<?php

use Calificaciones\Modelo\Mapeadores\Usuario as MapeadorUsuario;

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends C_Controller {

    /**
     * @var MapeadorUsuario
     */
    protected $mapeador;

    public function __construct($cargarDb = true)
    {
        parent::__construct($cargarDb);
        $this->mapeador = new MapeadorUsuario($this->adaptador);
    }


    public function listar()
    {
        $users = $this->mapeador->todos(false);

        $this->salida_json(200, [ 'success' => true, 'usuarios' => $users ]);
    }

	public function buscar($id)
	{
        $user = $this->mapeador->buscar($id);

		$this->salida_json(200, [ 'success' => true, 'usuario' => $user ]);
	}

    public function guardar($id = null)
    {
        $datos = $this->json_input();
        $usuario = $this->mapeador->mapea($datos['usuario']);
        $usuario->setId($id);

        $this->mapeador->guardar($usuario);

        $this->salida_json(200, [ 'success' => true, 'id' => $usuario->getId() ]);
	}

}
