/**
 * Created by jedabero on 15/11/16.
 */
import { Injectable } from "@angular/core";
import { Http, Headers, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import { Asignatura } from "../modelos/asignatura";

@Injectable()
export class AsignaturasServicio {

    private headers = new Headers({ 'Content-Type': 'application/json' });
    private baseUrl = "api/asignaturas/";

    constructor(private http: Http) { }

    crear(periodoId: number, asignatura: Asignatura) {
        let datos = JSON.stringify({ periodo_id: periodoId, asignatura });
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

    actualizar(asignatura: Asignatura) {
        return this.http
            .post(this.baseUrl+asignatura.id, JSON.stringify({ asignatura }), { headers: this.headers })
            .map((response: Response) => response.json());
    }

}