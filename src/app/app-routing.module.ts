/**
 * Created by jedabero on 5/11/16.
 */

import { NgModule }  from '@angular/core';
import { RouterModule, Routes }   from '@angular/router';

import { DataComponent } from './data.component';
import { DetailComponent } from './detail.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { LoginComponente } from './login/login.componente';
import { RegistroComponente } from './registro/registro.componente';

const routes: Routes = [
    {
        path: '',
        redirectTo: '/dashboard',
        pathMatch: 'full'
    }, {
        path: 'dashboard',
        component: DashboardComponent
    }, {
        path: 'login',
        component: LoginComponente
    }, {
        path: 'registrar',
        component: RegistroComponente
    }, {
        path: 'heroes',
        component: DataComponent
    }, {
        path: 'detail/:id',
        component: DetailComponent
    }
];

@NgModule({
    imports: [
        RouterModule.forRoot(routes)
    ],
    exports: [ RouterModule ]
})
export class AppRoutingModule {}