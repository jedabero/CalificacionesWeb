import {Nota} from "./nota";
/**
 * Created by jedabero on 15/11/16.
 */
export class Asignatura {
    id: number;
    estado: number;
    nombre: string;
    periodo_id: number;
    definitiva: number;
    notas: Nota[]
}