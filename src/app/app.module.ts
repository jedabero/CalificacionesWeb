import { NgModule }  from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { HttpModule }    from '@angular/http';

import { AppRoutingModule } from './app-routing.module';

import { AppComponent } from './app.component';
import { AutenticacionServicio } from './servicios/autenticacion.servicio';
import { LoginComponente } from './login/login.componente';
import { DashboardComponent } from './dashboard/dashboard.component';
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
        DashboardComponent,
        LoginComponente,
        DetailComponent,
        DataComponent
    ],
    providers: [
        AutenticacionServicio,
        DataService
    ],
    bootstrap: [ AppComponent ]
})
export class AppModule { }