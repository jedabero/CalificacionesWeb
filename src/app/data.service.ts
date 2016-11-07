/**
 * Created by jedabero on 5/11/16.
 */
import { Injectable } from '@angular/core';
import {Http, Headers} from "@angular/http";

import 'rxjs/add/operator/toPromise';

import { Heroe } from './heroe';

@Injectable()
export class DataService {

    private headers = new Headers({ 'Content-Type': 'application/json' });
    private dataUrl = 'api/usuarios';

    constructor(private http: Http) {}

    getHeroes(): Promise<Heroe[]> {
        return this.http.get(this.dataUrl)
            .toPromise()
            .then(response => response.json() as Heroe[])
            .catch(this.handleError);
    }

    getHeroe(id: number): Promise<Heroe> {
        return this.getHeroes().then(heroes => heroes.find(heroe => heroe.id == id));
    }

    getHeroesSlow(): Promise<Heroe[]> {
        return new Promise<Heroe[]>(resolve => setTimeout(resolve, 10000)).then(() => this.getHeroes());
    }

    private handleError(error: any): Promise<any> {
        console.error("Ocurrio un errror", error);
        return Promise.reject(error.message || error);
    }

    update(heroe: Heroe): Promise<Heroe> {
        const url = `${this.dataUrl}/${heroe.id}`;
        return this.http
            .post(url, JSON.stringify(heroe), { headers: this.headers })
            .toPromise()
            .then(() => heroe)
            .catch(this.handleError);
    }

    create(nombre: string): Promise<Heroe> {
        return this.http
            .post(this.dataUrl, JSON.stringify({nombre}), {headers: this.headers})
            .toPromise()
            .then(res => res.json())
            .catch(this.handleError);
    }

}
