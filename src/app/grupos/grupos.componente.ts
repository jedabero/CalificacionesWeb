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
    grupos: Grupo[];
    seleccionado: Grupo;
    constructor(
        private router: Router,
        private service: GruposServicio
    ) {}
    ngOnInit(): void {
        this.getGrupos();
    }
    onSelect(grupo: Grupo): void {
        this.seleccionado = grupo;
    }
    getGrupos(): void {
        this.service.listar().subscribe(
            data => this.grupos = data.grupos,
            error => console.log(error)
        );
    }
    gotoDetalle(): void {
        this.router.navigate([ '/grupos', this.seleccionado.id ]);
    }
    agregar(grupo: Grupo): void {
        if (!grupo) { return; }
        this.service.crear(grupo)
            .subscribe(
                data => {
                    grupo = data.grupo;
                    this.grupos.push(grupo);
                    this.seleccionado = grupo;
                },
                error => console.log(error)
            )
    }
}