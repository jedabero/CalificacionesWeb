import { NgModule }  from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { HttpModule }    from '@angular/http';

import { AppRoutingModule } from './app-routing.module';

import { AppComponent } from './app.component';
import { AutenticacionServicio } from './servicios/autenticacion.servicio';
import { UsuariosServicio } from './servicios/usuarios.servicio';
import { GruposServicio } from './servicios/grupos.servicio';

import { DashboardComponente } from './dashboard/dashboard.componente';
import { LoginComponente } from './login/login.componente';
import { LogoutComponente } from './login/logout.componente';
import { RegistroComponente } from './registro/registro.componente';

import { HomeComponente } from './home/home.componente';
import { GruposComponente } from './grupos/grupos.componente';
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
        GruposComponente,
        DetailComponent,
        DataComponent
    ],
    providers: [
        AutenticacionServicio,
        UsuariosServicio,
        GruposServicio,
        DataService
    ],
    bootstrap: [ AppComponent ]
})
export class AppModule { }