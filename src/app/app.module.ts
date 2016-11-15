import { NgModule }  from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { HttpModule }    from '@angular/http';

import { AppRoutingModule } from './app-routing.module';

import { AppComponent } from './app.component';
import { AutenticacionServicio, UsuariosServicio, GruposServicio, PeriodosServicio } from './servicios/index';
import { AuntenticacionGuardia } from './guardias/autenticacion.guardia';

import { DashboardComponente } from './dashboard/dashboard.componente';
import { LoginComponente, LogoutComponente } from './login/index';
import { RegistroComponente } from './registro/registro.componente';

import { HomeComponente } from './home/home.componente';
import { GruposComponente, GrupoComponente } from './grupos/index';
import { PeriodosComponente, PeriodoComponente } from './periodos/index';
import { DataComponent } from './data.component';
import { DetailComponent } from './detail.component';
import { DataService } from './data.service';

@NgModule({
    imports: [
        BrowserModule,
        FormsModule,
        HttpModule,
        AppRoutingModule
    ],
    declarations: [
        AppComponent,
        DashboardComponente,
        LoginComponente,
        LogoutComponente,
        RegistroComponente,
        HomeComponente,
        GruposComponente, GrupoComponente,
        PeriodosComponente, PeriodoComponente,
        DetailComponent,
        DataComponent
    ],
    providers: [
        AuntenticacionGuardia,
        AutenticacionServicio,
        UsuariosServicio,
        GruposServicio,
        PeriodosServicio,
        DataService
    ],
    bootstrap: [ AppComponent ]
})
export class AppModule { }