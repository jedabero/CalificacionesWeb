/**
 * Created by jedabero on 7/11/16.
 */
import {Component, OnInit} from '@angular/core';
import { Router } from '@angular/router';
import { AutenticacionServicio } from '../servicios/autenticacion.servicio';

@Component({
    moduleId: module.id,
    template: '',
})
export class LogoutComponente implements OnInit {

    constructor(
        private router: Router,
        private servicio: AutenticacionServicio
    ) {}

    ngOnInit(): void {
        this.servicio.logout();
        this.router.navigate(['/'])
    }

}