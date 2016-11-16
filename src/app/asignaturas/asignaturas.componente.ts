/**
 * Created by jedabero on 15/11/16.
 */
import { Component, OnInit, Input } from '@angular/core';
import { Router } from "@angular/router";

import { Asignatura } from '../modelos/asignatura';
import { AsignaturasServicio } from '../servicios/asignaturas.servicio';

@Component({
    moduleId: module.id,
    selector: 'asignaturas',
    templateUrl: 'asignaturas.componente.html',
    styleUrls: [ 'asignaturas.componente.css' ]
})
export class AsignaturasComponente implements OnInit {

    nuevo = new Asignatura();
    @Input()
    asignaturas: Asignatura[];
    @Input()
    periodoId: number;
    seleccionado: Asignatura;

    constructor(
        private router: Router,
        private service: AsignaturasServicio
    ) {}
    ngOnInit(): void {
        if (this.asignaturas == null) {
            this.get();
        }
    }
    get(): void {
        this.service.listar().subscribe(
            data => this.asignaturas = data.asignaturas,
            error => console.log(error)
        );
    }
    gotoDetalle(asignatura: Asignatura): void {
        this.router.navigate([ '/asignaturas', asignatura.id ]);
    }
    agregar(): void {
        console.log(JSON.stringify(this.nuevo));
        if (!this.nuevo.nombre) { return; }
        if (this.periodoId === 0) { return; }
        this.service.crear(this.periodoId, this.nuevo)
            .subscribe(
                data => {
                    let asignatura = data.asignatura;
                    this.asignaturas.push(asignatura);
                    this.seleccionado = asignatura;
                },
                error => console.log(error)
            )
    }
}