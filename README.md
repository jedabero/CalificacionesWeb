# Calificaciones WEB 

## Administrador web de calificaciones

En esta plataforma, estudiantes podrán administrar sus notas, ver un historial de promedios de periodos y acumulado por cada una de las carreras o curso que quiera administrar.  

De cada usuario se requiere su identificación, nombres, apellidos, un usuario único, y una contraseña.  
Después de ingresar el usuario podrá observar estadísticas sencillas sobre los grupos, periodos y asignaturas que ha almacenado, y podrá acceder por un enlace al módulo de grupos.  

Un grupo (carrera, especialización, curso, etc.) tiene un nombre que lo identifica y un listado de periodos. En el módulo de grupos el usuario puede crear, ver y eliminar grupos. En el módulo de detalle de grupo el usuario puede actualizar los datos del grupo, ver el módulo de periodos del grupo y además podrá ver un reporte de los promedios de los periodos del grupo, el promedio general y el promedio acumulado.  

Un periodo (semestre, trimestre, etc.) tiene un nombre que lo identifica, un orden que indica su ubicación dentro de un listado de periodos, una lista de asignaturas y un promedio que depende de las definitivas de las asignaturas. En el módulo de periodos el usuario puede crear, ver y eliminar periodos. En el módulo de detalle de periodo se puede actualizar los datos del periodo y ver el módulo de asignaturas del periodo.  

Una asignatura (materia, etc.) tiene un nombre que lo identifica, un listado de notas y una definitiva que depende del valor ponderado de las notas. En el módulo de asignaturas se puede crear, ver y eliminar asignaturas. En el módulo de detalle de asignatura el usuario puede actualizar los datos de la asignatura y ver el módulo de notas de la asignatura.  

Una nota (calificación, score, etc.) tiene un valor decimal, un peso decimal, un orden y de manera derivada un valor ponderado que depende del valor y el peso de la nota. En el módulo de notas se puede crear, ver, eliminar notas (éstas acciones deben actualizar la asignatura) y ver el módulo de detalle de nota de la nota seleccionada. En el módulo de detalle de nota el usuario puede actualizar los datos de la nota.

## Estructura de directorios

```
codeigniter/
├── application/
├── bin/
├── node_modules/
├── public/
│   ├── .htaccess
│   └── index.php
├── src/
│   ├── app/ (ts)
│   ├── Calificaciones/ (php)
│   ├── css/
│   └── systemjs.config.js
├── vendor/
|   └── codeigniter/
|       └── framework/
|           └── system/
├── composer.json
├── composer.lock
├── gulpfile.js
├── package.json
└── tsconfig.json
```

Revisa el archivo `gulpfile.js` para conocer sobre las tareas necesarias para la compilación del código del front.


## Requerimientos

* PHP 5.3.7 o mayor
* `composer` (Ver [Instalar Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx))
* Git
* nodejs y `npm`, revisar las depencias de desarrollador en `package.json` 


### Ejecutar con el servidor interno de PHP (PHP 5.4 o mayor)

```
$ bin/server.sh
```

### Actualizar CodeIgniter

```
$ cd /path/to/codeigniter
$ composer update
```

Se deben actualizar manualmente los acrchivos en la carpeta `application` o el archivo `index.php`. Revisar [CodeIgniter Guia de Usuario](http://www.codeigniter.com/user_guide/installation/upgrading.html).

## Referencia

* [Composer Installation](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
* [CodeIgniter](https://github.com/bcit-ci/CodeIgniter)
* [Translations for CodeIgniter System](https://github.com/bcit-ci/codeigniter3-translations)
* [CodeIgniter Composer Installer Latest Stable Version](https://packagist.org/packages/kenjis/codeigniter-composer-installer)
