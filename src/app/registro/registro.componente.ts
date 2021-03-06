/**
 * Created by jedabero on 7/11/16.
 */
import {Component, Input} from '@angular/core';
import { Router } from '@angular/router';
import { UsuariosServicio } from '../servicios/usuarios.servicio';
import { Usuario } from "../modelos/usuario";

@Component({
    moduleId: module.id,
    templateUrl: 'registro.componente.html',
    styleUrls: [ 'registro.componente.css' ]
})
export class RegistroComponente {

    @Input()
    usuario = new Usuario();

    cargando = false;

    constructor(
        private router: Router,
        private servicio: UsuariosServicio
    ) {}

    registrar(): void {
        this.cargando = false;
        this.servicio.crear(this.usuario)
            .subscribe(
                data => this.router.navigate(['/login']),
                error => {
                    console.log(error);
                    alert("No se pudo realizar el registro.");
                    this.cargando = false;
                }
            )
    }

}