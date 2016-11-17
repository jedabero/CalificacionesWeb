/**
 * Created by jedabero on 16/11/16.
 */
import {Headers, Http, Response} from "@angular/http";
import {Injectable} from "@angular/core";

@Injectable()
export class EstadisticasServicio {

    private headers = new Headers({ 'Content-Type': 'application/json' });
    private baseUrl = "api/estadisticas/";

    constructor(private http: Http) { }

    get() {
        return this.http
            .get(this.baseUrl)
            .map((response: Response) => response.json());
    }

}