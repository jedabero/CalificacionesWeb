/**
 * Created by jedabero on 16/11/16.
 */
import {Component, OnInit, Input} from '@angular/core';
import { Router } from "@angular/router";

import { Periodo } from '../modelos/periodo';

@Component({
    moduleId: module.id,
    selector: 'grafico-periodos',
    templateUrl: 'grafico-periodos.componente.html',
})
export class GraficoPeriodosComponente implements OnInit {

    @Input()
    periodos: Periodo[];

    chartData: Array<any>;
    labels: Array<string>;
    options: any = {
        responsive: true
    };
    colors: Array<any> = [
        { // grey
            backgroundColor: 'rgba(148,159,177,0.2)',
            borderColor: 'rgba(148,159,177,1)',
            pointBackgroundColor: 'rgba(148,159,177,1)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgba(148,159,177,0.8)'
        }, { // dark grey
            backgroundColor: 'rgba(77,83,96,0)',
            borderColor: 'rgba(77,83,96,1)',
            pointBackgroundColor: 'rgba(77,83,96,1)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgba(77,83,96,1)'
        }, { // grey
            backgroundColor: 'rgba(148,159,177,0)',
            borderColor: 'rgba(148,159,177,1)',
            pointBackgroundColor: 'rgba(148,159,177,1)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgba(148,159,177,0.8)'
        }
    ];
    legend: boolean = true;
    type: string = 'line';

    constructor(
        private router: Router
    ) {}
    ngOnInit(): void {
        if (this.periodos) {
            this.chartData = [];
            this.labels = [];
            let data = [], dataPromedio = [], dataPromedioAcumulado = [];
            let promedio = 0;
            this.periodos.forEach((periodo, i) => {
                promedio += periodo.promedio;
                dataPromedioAcumulado.push(promedio/(i + 1))
                data.push(periodo.promedio);
                this.labels.push(periodo.nombre);
            });
            promedio /= this.periodos.length;
            this.periodos.forEach(() => {
                dataPromedio.push(promedio);
            });
            this.chartData.push({
                data,
                label: 'Grupo'
            });
            this.chartData.push({
                data: dataPromedio,
                label: 'Promedio'
            });
            this.chartData.push({
                data: dataPromedioAcumulado,
                label: 'Acumulado'
            });
        }
    }

    gotoDetalle(periodo: Periodo): void {
        this.router.navigate([ '/periodos', periodo.id ]);
    }
}