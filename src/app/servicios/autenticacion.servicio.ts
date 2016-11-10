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

    login(usuario: string, contrasena: string) {
        return this.http
            .post(this.loginUrl, JSON.stringify({ usuario, contrasena }))
            .map((response: Response) => {
                let data = response.json();
                if (data && data.success && data.conectado) {
                    localStorage.setItem('session_id', data.session_id);
                    localStorage.setItem('usuario', data.usuario);
                }
                return { success: data.success, mensaje: data.mensaje };
            });
    }

    logout() {
        return this.http
            .post(this.logoutUrl, null)
            .map((response: Response) => {
                localStorage.removeItem('usuario');
                localStorage.removeItem('session_id');
            });
    }
}