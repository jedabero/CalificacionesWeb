/**
 * Created by jedabero on 13/11/16.
 */
import { Component, OnInit } from '@angular/core';
import {Router} from "@angular/router";

import { Grupo } from '../modelos/grupo';
import { GruposServicio } from '../servicios/grupos.servicio';

@Component({
    moduleId: module.id,
    templateUrl: 'grupos.componente.html',
    styleUrls: [ 'grupos.componente.css' ]
})
export class GruposComponente implements OnInit {

    nuevoGrupo = new Grupo();
    grupos: Grupo[];
    seleccionado: Grupo;

    constructor(
        private router: Router,
        private service: GruposServicio
    ) {}
    ngOnInit(): void {
        this.getGrupos();
    }
    getGrupos(): void {
        this.service.listar().subscribe(
            data => this.grupos = data.grupos,
            error => console.log(error)
        );
    }
    gotoDetalle(grupo: Grupo): void {
        this.router.navigate([ '/grupos', grupo.id ]);
    }
    agregar(): void {
        console.log(JSON.stringify(this.nuevoGrupo));
        if (!this.nuevoGrupo.nombre) { return; }
        this.service.crear(this.nuevoGrupo)
            .subscribe(
                data => {
                    let grupo = data.grupo;
                    this.grupos.push(grupo);
                    this.seleccionado = grupo;
                },
                error => console.log(error)
            )
    }
}