/**
 * Created by jedabero on 15/11/16.
 */
import { Component, OnInit, Input } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Location } from '@angular/common';

import { Nota } from '../modelos/nota';
import { NotasServicio } from '../servicios/notas.servicio';

@Component({
    moduleId: module.id,
    selector: 'nota',
    templateUrl: 'nota.componente.html',
    styleUrls: [ 'nota.componente.css' ]
})
export class NotaComponente implements OnInit {
    @Input()
    nota: Nota;

    constructor(
        private service: NotasServicio,
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
            data => this.nota = data.nota,
            error => {
                console.log(error);
                this.goBack();
            }
        );
    }

    guardar() {
        this.service.actualizar(this.nota).subscribe(
            data => this.goBack(),
            error => console.log(error)
        );
    }

    goBack(): void {
        this.location.back();
    }
}