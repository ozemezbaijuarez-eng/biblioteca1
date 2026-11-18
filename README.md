
#  Sistema de Control de Biblioteca

Un sistema web ligero y funcional desarrollado para gestionar el registro, inventario y visualización de libros, utilizando **PHP**, **MySQL**, **HTML**, **CSS** y **JavaScript**.

![biblioteca](https://img.magnific.com/vector-gratis/concepto-biblioteca-digital_1284-12676.jpg?semt=ais_hybrid&w=740&q=80)

---

##  Estructura del Proyecto

El proyecto está compuesto por 4 archivos principales:

* **`index.php`**: Página principal que muestra la interfaz visual. Contiene el formulario de registro y una tabla dinámica que lista el inventario actual de libros desde la base de datos.
* **`guardar.php`**: Script backend encargado de recibir los datos del formulario por método POST, limpiar las variables contra inyecciones SQL básicas e insertar el nuevo libro en la base de datos.
* **`script.js`**: Archivo de JavaScript del lado del cliente que realiza validaciones en tiempo real de los campos del formulario antes de enviarlos y maneja las alertas de éxito mediante parámetros en la URL.
* **`styles.css`**: Hoja de estilos encargada del diseño visual, utilizando variables CSS, diseño adaptable  y estilos para las tablas y estados de los libros.

---

##  Requisitos Técnicos

* Servidor web con soporte para **PHP** (como XAMPP, Laragon o un servicio de hosting como AwardSpace).
* Base de datos **MySQL** con una tabla llamada `libros` que contenga al menos los siguientes campos:
  * `id` (Entero, Auto-incremental, clave primaria)
  * `titulo` (Texto)
  * `autor` (Texto)
  * `isbn` (Texto)
  * `disponible` (Booleano o tinyInt para el estado)

---

##  Configuración y Uso

1. Sube o coloca todos los archivos en el directorio raíz de tu servidor web local o remoto.
2. Configura tus credenciales de conexión a la base de datos (host, usuario, contraseña y nombre de la base de datos) en los archivos `index.php` y `guardar.php`.
3. Abre el archivo `index.php` en tu navegador web para comenzar a registrar y consultar libros en el inventario.
