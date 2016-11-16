/**
 * Created by jedabero on 14/11/16.
 */
import { Injectable } from "@angular/core";
import { Http, Headers, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import { Periodo } from "../modelos/periodo";

@Injectable()
export class PeriodosServicio {

    private headers = new Headers({ 'Content-Type': 'application/json' });
    private baseUrl = "api/periodos/";

    constructor(private http: Http) { }

    crear(grupoId: number, periodo: Periodo) {
        let datos = JSON.stringify({ grupo_id: grupoId, periodo });
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

    actualizar(periodo: Periodo) {
        return this.http
            .post(this.baseUrl+periodo.id, JSON.stringify({ periodo }), { headers: this.headers })
            .map((response: Response) => response.json());
    }

}