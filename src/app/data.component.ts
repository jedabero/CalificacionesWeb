import { Component, OnInit } from '@angular/core';
import {Router} from "@angular/router";

import { Heroe } from './heroe';
import { DataService } from './data.service';

@Component({
    moduleId: module.id,
    selector: 'data',
    templateUrl: 'data.component.html',
    styleUrls: [ 'data.component.css' ]
})
export class DataComponent implements OnInit {
    heroes: Heroe[];
    heroeSeleccionado: Heroe;
    constructor(
        private router: Router,
        private service: DataService
    ) {}
    ngOnInit(): void {
        this.getHeroes();
    }
    onSelect(heroe: Heroe): void {
        this.heroeSeleccionado = heroe;
    }
    getHeroes(): void {
        this.service.getHeroes().then(heroes => this.heroes = heroes);
    }
    gotoDetail(): void {
        this.router.navigate([ '/detail', this.heroeSeleccionado.id ]);
    }
    add(nombre: string): void {
        nombre = nombre.trim();
        if (!nombre) { return; }
        this.service.create(nombre).then(heroe => {
            this.heroes.push(heroe);
            this.heroeSeleccionado = heroe;
        })
    }
}