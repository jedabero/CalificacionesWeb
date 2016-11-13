import { Component, OnInit } from '@angular/core';
import {Router} from "@angular/router";

@Component({
    moduleId: module.id,
    templateUrl: 'home.componente.html',
    styleUrls: [ 'home.componente.css' ]
})
export class HomeComponente implements OnInit {

    constructor(
        private router: Router
    ) {}
    ngOnInit(): void {
        // TODO
    }

    gotoGrupos(): void {
        this.router.navigate([ '/grupos' ]);
    }

}