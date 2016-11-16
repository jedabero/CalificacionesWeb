/**
 * Created by jedabero on 15/11/16.
 */
import { Component, Input } from '@angular/core';
import { Location } from '@angular/common';

import { Nota } from '../modelos/nota';
import { NotasServicio } from '../servicios/notas.servicio';

@Component({
    moduleId: module.id,
    selector: 'nota',
    templateUrl: 'nota.componente.html',
    styleUrls: [ 'nota.componente.css' ]
})
export class NotaComponente {
    @Input()
    nota: Nota;

    constructor(
        private service: NotasServicio,
        private location: Location
    ) {}

    guardar() {
        this.service.actualizar(this.nota).subscribe(
            data => console.log(data), // TODO: actualizar asignatura
            error => console.log(error)
        );
    }

    goBack(): void {
        this.location.back();
    }
}