/**
 * Created by jedabero on 7/11/16.
 */
import { Injectable } from "@angular/core";
import { Http, Headers, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map';

@Injectable()
export class AutenticacionServicio {

    private loginUrl = "api/autenticacion/login";
    private logoutUrl = "api/autenticacion/logout";

    constructor(private http: Http) { }

    login(usuario: string, constrasena: string) {
        return this.http
            .post(this.loginUrl, JSON.stringify({ usuario, constrasena }))
            .map((response: Response) => {
                let user = response.json();
                if (user && user.token) {
                    localStorage.setItem('usuario', JSON.stringify(user));
                }
            });
    }

    logout() {
        return this.http
            .post(this.logoutUrl, null)
            .map((response: Response) => {
                localStorage.removeItem('usuario');
            });
    }
}