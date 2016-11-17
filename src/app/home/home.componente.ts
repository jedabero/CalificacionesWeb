import { Component, OnInit } from '@angular/core';
import {Router} from "@angular/router";
import {Estadisticas} from "./estadisticas";
import {EstadisticasServicio} from "./estadisticas.servicio";


@Component({
    moduleId: module.id,
    templateUrl: 'home.componente.html',
    styleUrls: [ 'home.componente.css' ]
})
export class HomeComponente implements OnInit {

    estadisticas = new Estadisticas();

    constructor(
        private router: Router,
        private servicio: EstadisticasServicio
    ) {}
    ngOnInit(): void {
        this.servicio.get()
            .subscribe(
                data => {
                    if (data.success) {
                        this.estadisticas = data.estadisticas
                    }
                },
                error => console.log(error)
            )
    }

    gotoGrupos(): void {
        this.router.navigate([ '/grupos' ]);
    }

}