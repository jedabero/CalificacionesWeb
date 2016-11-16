/**
 * Created by jedabero on 15/11/16.
 */
import { Injectable } from "@angular/core";
import { Http, Headers, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import { Nota } from "../modelos/nota";

@Injectable()
export class NotasServicio {

    private headers = new Headers({ 'Content-Type': 'application/json' });
    private baseUrl = "api/notas/";

    constructor(private http: Http) { }

    crear(asignaturaId: number, nota: Nota) {
        let datos = JSON.stringify({ asignatura_id: asignaturaId, nota });
        return this.http
            .post(this.baseUrl, datos, { headers: this.headers })
            .map((response: Response) => response.json());
    }

    listar() {
        return this.http.get(this.baseUrl).map((response: Response) => response.json());
    }

    buscar(id: number) {
        return this.http.get(this.baseUrl+id).map((response: Response) => response.json());
    }

    actualizar(nota: Nota) {
        return this.http
            .post(this.baseUrl+nota.id, JSON.stringify({ nota }), { headers: this.headers })
            .map((response: Response) => response.json());
    }

}