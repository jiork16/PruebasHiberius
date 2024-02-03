# Prueba Técnica Hiberus

Se crearon dos aplicativos.
* Api-app(backend)
* FrontHiberius(fronted)

### Desarrollados en:
* [![Laravel][Laravel.com]][Laravel-url]
* [![Vue][Vue.js]][Vue-url]

## Instalacion
_Se detalla los pasos para instalar y compilar las aplicaciones._
1. Clonar el repositorio
   ```sh
   git clone https://github.com/jiork16/PruebasHiberius.git
2. Abrir una ventana de comando en la ruta donde fue clonado el repositorio.
3. Ejecutar los siguientes comandos en orden:
   ```docker
   docker-compose build(Compila y descarga la imagen php8.0.30 y apache)
   docker-compose up -d(Levanta el contendor llamado laravel-docker con el API en el puerto 9000, mysql en el puerto 3306 y el PhpAdmin en el puerto 9001 todos estos en el localhost)
   docker exec laravel-docker bash -c "composer install" (Instala la paquetería  necesaria para el API)
   docker exec laravel-docker bash -c "php artisan migrate --force" (Realiza las migraciones de las tablas)
   docker exec laravel-docker bash -c "php artisan db:seed" (Crea datos semilla para pruebas)
   docker exec laravel-docker bash -c "php artisan test" (Ejecuta las pruebas unitarias las cuales se crearon dos que correspóndete al servicio de ingreso de TRIPS)
3. Dirigirse a la ruta donde se encuentra el aplicativo frontend FrontHiberus
4. Ejecutar los siguientes comandos en orden:
   ```docker
   docker build -t front-hiberus . (Compila y descarga la imagen node)
   docker run -p 5000:8080 front-hiberus(Ejecuta el aplicativo frontend en el puerto 5000 del localhost)
<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->

[Vue.js]: https://img.shields.io/badge/Vue.js-35495E?style=for-the-badge&logo=vuedotjs&logoColor=4FC08D
[Vue-url]: https://vuejs.org/
[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com
