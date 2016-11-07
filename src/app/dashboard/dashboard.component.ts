/**
 * Created by jedabero on 5/11/16.
 */
import { Component, OnInit } from '@angular/core';

import { Heroe } from '../heroe';
import { DataService } from '../data.service';


@Component({
    moduleId: module.id,
    templateUrl: 'dashboard.component.html',
    styleUrls: [ 'dashboard.component.css' ]
})
export class DashboardComponent {

    heroes: Heroe[] = [];

    constructor(private service: DataService) {}

    ngOnInit(): void {
        this.service.getHeroes().then(heroes => this.heroes = heroes.slice(1, 5))
    }
}