/**
 * Created by jedabero on 5/11/16.
 */

import { NgModule }  from '@angular/core';
import { RouterModule, Routes }   from '@angular/router';

import { DataComponent } from './data.component';
import { DetailComponent } from './detail.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { LoginComponente } from './login/login.componente';
import { LogoutComponente } from './login/logout.componente';
import { RegistroComponente } from './registro/registro.componente';

const routes: Routes = [
    {
        path: '',
        component: DashboardComponent,
        children: [
            {
                path: '',
                redirectTo: 'heroes',
                pathMatch: 'full'
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