/**
 * Created by jedabero on 14/11/16.
 */
import { Component, OnInit, Input } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Location } from '@angular/common';

import { Grupo } from '../modelos/grupo';
import { GruposServicio } from '../servicios/grupos.servicio';

@Component({
    moduleId: module.id,
    templateUrl: 'grupo.componente.html',
    styleUrls: [ 'grupo.componente.css' ]
})
export class GrupoComponente implements OnInit {
    @Input()
    grupo: Grupo;

    constructor(
        private service: GruposServicio,
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
            data => this.grupo = data.grupo,
            error => console.log(error)
        );
    }

    guardar() {
        this.service.actualizar(this.grupo).subscribe(
            data => this.goBack(),
            error => console.log(error)
        );
    }

    goBack(): void {
        this.location.back();
    }
}