import { NgModule }  from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';

import { AppComponent } from './app.component';
import { DataComponent } from './data.component';
import { DetailComponent } from './detail.component';
import { DataService } from './data.service';
import { DashboardComponent } from './dashboard.component';
import { AppRoutingModule } from './app-routing.module';

@NgModule({
    imports: [
        BrowserModule,
        FormsModule,
        AppRoutingModule
    ],
    declarations: [
        AppComponent,
        DashboardComponent,
        DetailComponent,
        DataComponent
    ],
    providers: [ DataService ],
    bootstrap: [ AppComponent ]
})
export class AppModule { }