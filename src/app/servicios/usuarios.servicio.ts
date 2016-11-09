/**
 * Created by jedabero on 7/11/16.
 */
import { Injectable } from "@angular/core";
import { Http, Headers, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import { Usuario } from "../modelos/usuario";

@Injectable()
export class UsuariosServicio {

    private baseUrl = "api/usuarios/";

    constructor(private http: Http) { }

    crear(usuario: Usuario) {
        return this.http
            .post(this.baseUrl, JSON.stringify({ usuario }))
            .map((response: Response) => response.json());
    }

}