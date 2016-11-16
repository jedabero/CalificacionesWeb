/**
 * Created by jedabero on 14/11/16.
 */
import { Component, OnInit, Input } from '@angular/core';
import { Router } from "@angular/router";

import { Periodo } from '../modelos/periodo';
import { PeriodosServicio } from '../servicios/periodos.servicio';

@Component({
    moduleId: module.id,
    selector: 'periodos',
    templateUrl: 'periodos.componente.html',
    styleUrls: [ 'periodos.componente.css' ]
})
export class PeriodosComponente implements OnInit {

    nuevo = new Periodo();
    @Input()
    periodos: Periodo[];
    @Input()
    grupoId: number;
    seleccionado: Periodo;

    constructor(
        private router: Router,
        private service: PeriodosServicio
    ) {}
    ngOnInit(): void {
        if (this.periodos == null) {
            this.getPeriodos();
        }
    }
    getPeriodos(): void {
        this.service.listar().subscribe(
            data => this.periodos = data.grupos,
            error => console.log(error)
        );
    }
    gotoDetalle(periodo: Periodo): void {
        this.router.navigate([ '/periodos', periodo.id ]);
    }
    agregar(): void {
        console.log(JSON.stringify(this.nuevo));
        if (!this.nuevo.nombre) { return; }
        if (this.grupoId === 0) { return; }
        this.service.crear(this.grupoId, this.nuevo)
            .subscribe(
                data => {
                    let periodo = data.periodo;
                    this.periodos.push(periodo);
                    this.seleccionado = periodo;
                },
                error => console.log(error)
            )
    }
}