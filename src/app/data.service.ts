/**
 * Created by jedabero on 5/11/16.
 */
import { Injectable } from '@angular/core';
import { Heroe } from './heroe';
import { HEROES } from './mock-data';

@Injectable()
export class DataService {

    getHeroes(): Promise<Heroe[]> {
        return Promise.resolve(HEROES);
    }

    getHeroe(id: number): Promise<Heroe> {
        return this.getHeroes().then(heroes => heroes.find(heroe => heroe.id === id));
    }

    getHeroesSlow(): Promise<Heroe[]> {
        return new Promise<Heroe[]>(resolve => setTimeout(resolve, 10000)).then(() => this.getHeroes());
    }

}
