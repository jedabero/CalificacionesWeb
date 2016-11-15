/**
 * Created by jedabero on 14/11/16.
 */
import { Component, OnInit, Input } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Location } from '@angular/common';

import { Periodo } from '../modelos/periodo';
import { PeriodosServicio } from '../servicios/periodos.servicio';

@Component({
    moduleId: module.id,
    templateUrl: 'periodo.componente.html',
    styleUrls: [ 'periodo.componente.css' ]
})
export class PeriodoComponente implements OnInit {
    @Input()
    periodo: Periodo;

    constructor(
        private service: PeriodosServicio,
        private route: ActivatedRoute,
        private location: Location
    ) {}

    ngOnInit(): void {
        this.route.params.forEach((params: Params) => {
            let id = +params['id'];
            this.getGrupo(id);
        });
    }

    getGrupo(id: number): void {
        this.service.buscar(id).subscribe(
            data => this.periodo = data.periodo,
            error => {
                console.log(error);
                this.goBack();
            }
        );
    }

    guardar() {
        this.service.actualizar(this.periodo).subscribe(
            data => this.goBack(),
            error => console.log(error)
        );
    }

    goBack(): void {
        this.location.back();
    }
}