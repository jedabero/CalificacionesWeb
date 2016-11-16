/**
 * Created by jedabero on 5/11/16.
 */

import { NgModule }  from '@angular/core';
import { RouterModule, Routes }   from '@angular/router';

import { AuntenticacionGuardia } from "./guardias/autenticacion.guardia";

import { DashboardComponente } from './dashboard/dashboard.componente';
import { HomeComponente } from './home/home.componente';
import { GruposComponente, GrupoComponente } from './grupos/index';
import { PeriodosComponente, PeriodoComponente } from './periodos/index';
import { AsignaturasComponente, AsignaturaComponente } from './asignaturas/index';
import { DataComponent } from './data.component';
import { DetailComponent } from './detail.component';

import { LoginComponente, LogoutComponente } from './login/index';
import { RegistroComponente } from './registro/registro.componente';

const routes: Routes = [
    {
        path: '',
        component: DashboardComponente,
        canActivate: [ AuntenticacionGuardia ],
        children: [
            {
                path: '',
                canActivate: [ AuntenticacionGuardia ],
                component: HomeComponente
            }, {
                path: 'grupos',
                component: GruposComponente
            }, {
                path: 'grupos/:id',
                component: GrupoComponente
            }, {
                path: 'periodos/:id',
                component: PeriodoComponente
            }, {
                path: 'asignaturas/:id',
                component: AsignaturaComponente
            }, {
                path: 'heroes',
                component: DataComponent
            }, {
                path: 'detail/:id',
                component: DetailComponent
            }
        ]
    }, {
        path: 'login',
        component: LoginComponente
    }, {
        path: 'logout',
        component: LogoutComponente
    }, {
        path: 'registrar',
        component: RegistroComponente
    }
];

@NgModule({
    imports: [
        RouterModule.forRoot(routes)
    ],
    exports: [ RouterModule ]
})
export class AppRoutingModule {}