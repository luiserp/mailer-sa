<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Instalación:
* Debe configuarar la conexión con la base de datos en el archivo .env
* Debe configuarar la conexión con el servidor de mensages en el archivo .env, para el ejercicio se utiluzó Mailtrap
1. `composer install`
2. `npm install`
3. `php artisan migrate`
4. `php artisan db:seed`

## Ejecución:
1. `npm run dev`
2. `php artisan serve`
    - [Open Browser](http://127.0.0.1:8000)
3. Para procesar la cola de mensages: `php artisan queue:work`

## PRUEBA TÉCNICA LARAVEL - FullStack DEVELOPER
Este pequeño documento describe un desafío de programación que quisiéramos que nos ayudes a desarrollar, para conocer mejor tus habilidades y entender si tu conocimiento y experiencia son adecuados para lo que estamos buscando. 

### Requerimiento general:
- La empresa ficticia “MAILER S.A.” desea realizar una aplicación web que permita administrar la información de sus usuarios, cada usuario podrá realizar el envío de emails, por seguridad de la información el usuario tendrá que autenticarse en la aplicación con sus credenciales, para esto el personal a cargo del proyecto ha identificado los siguientes requerimientos:

### Consideraciones Generales
- Escribir código limpio, legible, desacoplado y fácil de mantener con las mejores prácticas que conozcas.
- No olvidar realizar comentarios en el código si lo consideras necesario.
- Realizar migraciones y seeders.
- Todas las relaciones del diseño de la base de datos deben verse reflejadas en los modelos de Laravel usando Eloquent

### Requerimientos Técnicos
- La empresa desea que su software sea desarrollado con el lenguaje de programación PHP haciendo uso de su framework Laravel.
- Nos encantaría conocer el avance del proyecto desde su inicio hasta la entrega, por ello nos encantaría que el código sea versionado mediante una plataforma git pública.

### Requerimiento Funcionales
#### Administración
- Se desea que los datos del usuario administrador del sistema sean ingresados mediante un seeder.
- Cuando el administrador se haya logueado, puede ver sus datos y la opción de cerrar sesión.

#### Autenticación
- Con base en la autenticación que ofrece Laravel, se debe permitir el acceso a los usuarios de la empresa por medio de email y una contraseña, una vez logueado, el usuario puede ver sus datos y la opción de cerrar sesión.
- Por seguridad de la aplicación, se solicita que se realicen las validaciones correspondientes de los campos de inicio de sesión.

#### Módulo de usuarios
- Este módulo será visible solo para el administrador del sistema.
- Ingreso de usuarios en el sistema por el rol administrador
- Para el formulario de registro de usuarios se necesitan los siguientes campos con sus respectivas validaciones y mensajes de error:
    * Email.- Dato obligatorio, debe ser único, se debe verificar que el email ingresado sea válido.
    * Contraseña.- Dato obligatorio, mínimo de 8 caracteres, debe contener al menos un número, una letra mayúscula, un carácter especial.
    * Identificador.- Dato obligatorio, numérico.
    * Verificación de contraseña.- El usuario debe verificar su contraseña.
    * Nombre.- Dato obligatorio, longitud de 100 caracteres.
    * Número Celular.- Dato opcional de 10 dígitos
    * Cédula.- Dato de tipo texto, obligatorio con longitud máxima de 11 caracteres.
    * Fecha de nacimiento.- Dato obligatorio, el usuario no puede ser menor de 18 años.
    * Código de Ciudad.- Dato obligatorio de tipo numérico.
- El formulario debe considerar tres campos de tipo select o autocompletado (anidados), destinados a la selección de país, estado y ciudad, estos campos deben cargarse en ese orden mediante una petición ajax, la ciudad seleccionada será relacionada al usuario.
- Cuando el formulario sea llenado de forma exitosa, el sistema debe guardar la contraseña del usuario de forma encriptada.

#### Visualización de Datos
- Para visualizar los datos de los usuarios de forma ágil, se requiere la realización de una interfaz que contenga una tabla de datos o DataTable, debe contener una sección de filtros y paginación bajo el siguiente detalle:
- Se solicita un filtro general (campo de texto) que busque por nombre, cédula, email, celular.
- La tabla de datos debe ordenarse por columnas.
- La tabla de datos debe mostrar todos los campos de los usuarios excepto el password.
- La tabla de datos debe visualizar una columna de edad, aunque no se guarde en base de datos.
- La tabla de datos debe tener una paginación del lado del servidor (server side) y debe ser configurable la cantidad de registros por página.

#### Actualización y Eliminación de Usuarios
- Desde la interfaz de visualización de datos el administrador debe ser capaz de editar su información o eliminar un registro de ser pertinente.
- Cuando se realice la edición de información se solicita la siguiente restricción: no se debe permitir cambiar la cédula ni el email del usuario.

#### Módulo de Emails
- Este módulo será visible solo para los usuarios del sistema y debe cumplir con los siguientes requerimientos:
- Solo los usuarios autenticados podrán acceder al formulario de creación de email, este formulario debe solicitar datos como asunto, destinatario y cuerpo del mensaje mensaje.
- Una vez ingresado los datos y procesado el formulario, el email creado estará relacionado con el usuario autenticado y será enviado en secuencia mediante una cola de emails.
- El email tendrá dos estados, mientras se mantenga en la cola de envío se considera “no enviado”, cuando ha sido procesado, es decir; se ha enviado el email tendrá el estado “enviado”.
- El procesamiento de la cola de emails se realizará mediante la ejecución de un comando artisan.
- Los usuarios podrán ver sus email con su estado, se recomienda la creación de una interfaz con una tabla de datos “data table”;
- El usuario administrador podrá visualizar todos los emails.
- Para los correos podrías usar mailtrap para ahorrarte tiempo.

#### Opcional
- Por motivos de seguridad de la información, la empresa deja abierta la posibilidad de implementar un sistema de logs para revisar los cambios históricos de los registro de usuarios y envío de emails.
- Si consideras que podrías implementar alguna funcionalidad adicional para demostrar tus capacidades, nos encantaría verte en acción.

#### Consideraciones Finales
- La empresa posee una estimación de tiempos acorde a los requerimientos solicitados al aspirante del proyecto, para que la entrega cumpla con los parámetros de aceptación se recomienda lo siguiente:
- Dar prioridad a la parte funcional en lugar de la visual.
- Nos encantaría ver tu proyecto en un repositorio en GIT público.
- Nuestro stack es Laravel con Vue.js. y Tailwind (nos gusta mucho más que bootstrap). Aunque para este proyecto no necesariamente tienes que usar vue, si nos encantaría que nos demuestres tus habilidades con javascript que también lo usamos ampliamente.  
- Nos encantaría que nos envíes el resultado de esta prueba entre 1 o 2 días. (consideramos que un perfil senior con experiencia podría terminar este desafío en menos de 5 horas)
- Luego de que nos envíes tu proyecto, coordinaremos una reunión con alguien de nuestro equipo técnico para hacerte algunas preguntas y para que nos enseñes tu código tu mismo.
- Es importante recalcar que estamos buscando conocer mejor tus habilidades, por lo que, es necesario que el proyecto sea realizado desde cero y con las mejores prácticas de desarrollo de software posibles.