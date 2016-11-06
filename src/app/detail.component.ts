/**
 * Created by jedabero on 4/11/16.
 */

import { Component, Input, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from '@angular/router';
import { Location } from '@angular/common';

import { DataService } from './data.service';
import { Heroe } from './heroe';

@Component({
    moduleId: module.id,
    selector: 'detalle',
    templateUrl: 'detail.component.html',
    styleUrls: [ 'detail.component.css' ]
})

export class DetailComponent implements OnInit{
    @Input()
    heroe: Heroe;

    constructor(
        private service: DataService,
        private route: ActivatedRoute,
        private location: Location
    ) {}

    ngOnInit(): void {
        this.route.params.forEach((params: Params) => {
            let id = +params['id'];
            this.service.getHeroe(id).then(heroe => this.heroe = heroe);
        });
    }

    goBack(): void {
        this.location.back();
    }
}