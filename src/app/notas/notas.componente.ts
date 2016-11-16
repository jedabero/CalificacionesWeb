/**
 * Created by jedabero on 15/11/16.
 */
import { Component, OnInit, Input } from '@angular/core';
import { Router } from "@angular/router";

import { Nota } from '../modelos/nota';
import { NotasServicio } from '../servicios/notas.servicio';

@Component({
    moduleId: module.id,
    selector: 'notas',
    templateUrl: 'notas.componente.html',
    styleUrls: [ 'notas.componente.css' ]
})
export class NotasComponente implements OnInit {

    nuevo = new Nota();
    @Input()
    notas: Nota[];
    @Input()
    asignaturaId: number;
    seleccionado: Nota;

    constructor(
        private router: Router,
        private service: NotasServicio
    ) {}
    ngOnInit(): void {
        if (this.notas == null) {
            this.get();
        }
    }
    get(): void {
        this.service.listar().subscribe(
            data => this.notas = data.notas,
            error => console.log(error)
        );
    }
    onSelect(nota: Nota): void {
        this.seleccionado = nota;
    }
    agregar(): void {
        console.log(JSON.stringify(this.nuevo));
        if (this.nuevo.valor === null) { return; }
        if (!this.nuevo.peso) { return; }
        if (this.asignaturaId === 0) { return; }
        this.service.crear(this.asignaturaId, this.nuevo)
            .subscribe(
                data => {
                    let nota = data.nota;
                    this.notas.push(nota);
                    this.seleccionado = nota;
                },
                error => console.log(error)
            )
    }
}