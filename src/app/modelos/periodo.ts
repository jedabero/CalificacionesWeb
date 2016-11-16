import {Asignatura} from "./asignatura";
/**
 * Created by jedabero on 14/11/16.
 */
export class Periodo {
    id: number;
    estado: number;
    nombre: string;
    orden: number;
    grupo_id: number;
    promedio: number;
    asignaturas: Asignatura[];
}