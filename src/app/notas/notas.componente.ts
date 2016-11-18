/**
 * Created by jedabero on 15/11/16.
 */
import {Component, OnInit, Input, Output, EventEmitter} from '@angular/core';
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

    nuevaNota = new Nota();
    @Input()
    notas: Nota[];
    @Input()
    asignaturaId: number;
    notaSeleccionada: Nota;

    @Output()
    actualizar = new EventEmitter();

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
        this.notaSeleccionada = nota;
    }
    agregar(): void {
        console.log(JSON.stringify(this.nuevaNota));
        if (this.nuevaNota.valor === null) { return; }
        if (!this.nuevaNota.peso) { return; }
        if (this.asignaturaId === 0) { return; }
        this.service.crear(this.asignaturaId, this.nuevaNota)
            .subscribe(
                data => {
                    let nota = data.nota;
                    this.notas.push(nota);
                    this.notaSeleccionada = nota;
                    this.actualizarComponente();
                },
                error => console.log(error)
            )
    }

    actualizarComponente(): void {
        this.actualizar.next();
    }
}