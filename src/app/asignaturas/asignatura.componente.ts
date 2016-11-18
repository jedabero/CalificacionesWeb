/**
 * Created by jedabero on 15/11/16.
 */
import { Component, OnInit, Input } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Location } from '@angular/common';

import { Asignatura } from '../modelos/asignatura';
import { AsignaturasServicio } from '../servicios/asignaturas.servicio';

@Component({
    moduleId: module.id,
    templateUrl: 'asignatura.componente.html',
    styleUrls: [ 'asignatura.componente.css' ]
})
export class AsignaturaComponente implements OnInit {
    @Input()
    asignatura: Asignatura;

    constructor(
        private service: AsignaturasServicio,
        private route: ActivatedRoute,
        private location: Location
    ) {}

    ngOnInit(): void {
        this.route.params.forEach((params: Params) => {
            let id = +params['id'];
            this.get(id);
        });
    }

    get(id: number): void {
        this.service.buscar(id).subscribe(
            data => this.asignatura = data.asignatura,
            error => {
                console.log(error);
                this.goBack();
            }
        );
    }

    guardar() {
        this.service.actualizar(this.asignatura).subscribe(
            data => this.goBack(),
            error => console.log(error)
        );
    }

    goBack(): void {
        this.location.back();
    }

    actualizar() {
        this.get(this.asignatura.id);
    }
}