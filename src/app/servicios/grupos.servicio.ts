/**
 * Created by jedabero on 13/11/16.
 */
import { Injectable } from "@angular/core";
import { Http, Headers, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import { Grupo } from "../modelos/grupo";

@Injectable()
export class GruposServicio {

    private baseUrl = "api/grupos/";

    constructor(private http: Http) { }

    crear(grupo: Grupo) {
        return this.http
            .post(this.baseUrl, JSON.stringify({ grupo }))
            .map((response: Response) => response.json());
    }

}