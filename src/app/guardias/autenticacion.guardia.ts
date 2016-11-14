/**
 * Created by jedabero on 14/11/16.
 */

import { Injectable } from '@angular/core';
import { Router, CanActivate } from '@angular/router';

@Injectable()
export class AuntenticacionGuardia implements CanActivate {

    constructor(private router: Router) { }

    canActivate() {
        if (localStorage.getItem('session_id') && localStorage.getItem('usuario')) {
            return true;
        }

        this.router.navigate([ '/login' ]);
        return false;
    }

}