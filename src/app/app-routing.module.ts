/**
 * Created by jedabero on 5/11/16.
 */

import { NgModule }  from '@angular/core';
import { RouterModule, Routes }   from '@angular/router';

import { DashboardComponente } from './dashboard/dashboard.componente';
import { HomeComponente } from './home/home.componente';
import { DataComponent } from './data.component';
import { DetailComponent } from './detail.component';

import { LoginComponente } from './login/login.componente';
import { LogoutComponente } from './login/logout.componente';
import { RegistroComponente } from './registro/registro.componente';

const routes: Routes = [
    {
        path: '',
        component: DashboardComponente,
        children: [
            {
                path: '',
                component: HomeComponente
            }, {
                path: 'grupos',
                component: GruposComponente
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