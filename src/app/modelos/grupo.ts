import { Periodo } from "./periodo";
/**
 * Created by jedabero on 13/11/16.
 */

export class Grupo {
    id: number;
    estado: number;
    nombre: string;
    usuario_id: number;
    periodos: Periodo[];
}