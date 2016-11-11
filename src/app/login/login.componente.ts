/**
 * Created by jedabero on 7/11/16.
 */
import {Component, OnInit, Input} from '@angular/core';
import { Router } from '@angular/router';
import { AutenticacionServicio } from '../servicios/autenticacion.servicio';

@Component({
    moduleId: module.id,
    templateUrl: 'login.componente.html',
    styleUrls: [ 'login.componente.css' ]
})
export class LoginComponente {

    @Input()
    usuario: string;
    @Input()
    contrasena: string;

    cargando = false;

    constructor(
        private router: Router,
        private servicio: AutenticacionServicio
    ) {}

    ngOnInit(): void {
        // this.servicio.logout();
    }

    login(): void {
        this.cargando = false;
        this.servicio.login(this.usuario, this.contrasena)
            .subscribe(
                data => this.router.navigate(['/']),
                error => {
                    console.log(error);
                    // TODO: mostrar login no exitoso
                    this.cargando = false;
                }
            )
    }

}