import { NgModule }  from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { HttpModule }    from '@angular/http';

import { AppRoutingModule } from './app-routing.module';

import { AppComponent } from './app.component';
import {
    AutenticacionServicio, UsuariosServicio, GruposServicio,
    PeriodosServicio, AsignaturasServicio, NotasServicio
} from './servicios/index';
import { AuntenticacionGuardia } from './guardias/autenticacion.guardia';

import { DashboardComponente } from './dashboard/dashboard.componente';
import { LoginComponente, LogoutComponente } from './login/index';
import { RegistroComponente } from './registro/registro.componente';

import { HomeComponente } from './home/home.componente';
import { EstadisticasServicio } from './home/estadisticas.servicio';
import { GruposComponente, GrupoComponente } from './grupos/index';
import { PeriodosComponente, PeriodoComponente } from './periodos/index';
import { AsignaturasComponente, AsignaturaComponente } from './asignaturas/index';
import { NotasComponente, NotaComponente } from './notas/index';

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
        AsignaturasComponente, AsignaturaComponente,
        NotasComponente, NotaComponente,
    ],
    providers: [
        AuntenticacionGuardia,
        AutenticacionServicio,
        UsuariosServicio,
        EstadisticasServicio,
        GruposServicio,
        PeriodosServicio,
        AsignaturasServicio,
        NotasServicio,
    ],
    bootstrap: [ AppComponent ]
})
export class AppModule { }