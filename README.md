# 🎃 Desafío Halloween – Proyecto PHP + MySQL

## 🧩 Descripción general

Este proyecto consiste en el desarrollo de una aplicación web temática de Halloween que permite **registrar, visualizar y votar disfraces**.
Fue realizado en **PHP** con conexión a **MySQL**, utilizando HTML, CSS y JavaScript para la interfaz.
Incluye un **panel de administración** donde un usuario “admin” puede gestionar los disfraces (alta, baja y modificación).

---

## 🧠 Objetivos del trabajo

* Implementar un sistema web dinámico con PHP y MySQL.
* Utilizar funciones específicas del lenguaje para la manipulación de datos, archivos e imágenes.
* Aplicar conceptos de autenticación de usuarios y gestión de sesiones.
* Cumplir con los requisitos indicados en la **Guía PHP y MySQL – Halloween**.

---

## 🗃️ Estructura del proyecto

```
halloween_app/
│
├── index.php               # Página principal: muestra los disfraces y permite votar
├── registro.php            # Registro de nuevos usuarios
├── login.php               # Inicio de sesión
├── logout.php              # Cierre de sesión
├── admin.php               # Panel CRUD para el administrador
├── votar.php               # Lógica de votación
├── db.php                  # Conexión a la base de datos
│
├── css/
│   └── estilos.css         # Estilos del sitio (tema Halloween)
├── js/
│   └── script.js           # Funciones JS de interacción
├── imagenes/
│   └── fondo.jpg           # Imagen de fondo del sitio
└── fotos/
    └── (imágenes subidas de disfraces)
```

---

## 🗄️ Base de datos `halloween`

Tablas creadas:

* **usuarios**: almacena nombre y contraseña hasheada (`password_hash()`).
* **disfraces**: contiene nombre, descripción, votos y foto del disfraz.
* **votos**: registra qué usuario votó qué disfraz (para evitar votos duplicados).

Usuario administrador por defecto:

| Usuario | Contraseña |
| ------- | ---------- |
| `admin` | `admin123` |

---

## ⚙️ Tecnologías utilizadas

* **PHP 8+**
* **MySQL / MariaDB**
* **HTML5 / CSS3 / JavaScript**
* **XAMPP** (servidor local)
* **phpMyAdmin**

---

## 🔌 Conexión a la base de datos

El archivo `db.php` establece la conexión usando:

```php
$con = mysqli_connect('localhost', 'root', '', 'halloween', 3307);
```

> Ajustar el puerto según la configuración de MySQL (3306 o 3307).

---

## 🧙‍♀️ Funcionalidades principales

### 👥 Usuarios

* Registro de nuevos usuarios (`registro.php`)
* Inicio y cierre de sesión (`login.php`, `logout.php`)
* Contraseñas cifradas con `password_hash()` / `password_verify()`

### 🎭 Disfraces

* Listado general en `index.php`
* Subida de imágenes (con validación y almacenamiento en `/fotos`)
* Conteo de votos en tiempo real

### 🗳️ Votación

* Cada usuario puede votar **una sola vez por disfraz**
* Control implementado mediante `mysqli_num_rows()` y tabla intermedia `votos`

### 🧛‍♂️ Panel de administrador

* Alta, baja y modificación de disfraces
* Eliminación física del archivo con `unlink()`
* Validación de subida con `is_uploaded_file()` y `copy()`

---

## 🧩 Funciones PHP requeridas (utilizadas)

El proyecto implementa las funciones solicitadas por la guía:

| Función                       | Estado                                      |
| ----------------------------- | ------------------------------------------- |
| `mysqli_connect()`            | ✅                                           |
| `mysqli_query()`              | ✅                                           |
| `mysqli_num_rows()`           | ✅                                           |
| `mysqli_insert_id()`          | ✅ (para nuevos disfraces)                   |
| `mysqli_num_fields()`         | ✅ (usada para mostrar cantidad de columnas) |
| `mysqli_real_escape_string()` | ✅                                           |
| `$_FILES['foto']['name']`     | ✅                                           |
| `explode()` / `end()`         | ✅                                           |
| `is_uploaded_file()`          | ✅                                           |
| `time()`                      | ✅                                           |
| `copy()`                      | ✅                                           |
| `mysqli_error($con)`          | ✅                                           |
| `unlink()`                    | ✅                                           |
| `isset()`                     | ✅                                           |
| `file_exists()`               | ✅                                           |
| `number_format()`             | ✅ (usado para formatear votos)              |

---

## 🧾 Cómo ejecutar el proyecto

1. Instalar **XAMPP** y asegurarse de que **Apache** y **MySQL** estén activos.
2. Colocar la carpeta `halloween_app` dentro de `C:\xampp\htdocs\`.
3. Importar el archivo `halloween.sql` en phpMyAdmin.
4. Acceder desde el navegador a:

   ```
   http://localhost/desafio_halloween/
   ```
5. Iniciar sesión con:

   * Usuario: **admin**
   * Contraseña: **admin123**

---

## 🎃 Créditos y autoría

Proyecto desarrollado para la materia **Programación Web (PHP y MySQL)**
Universidad de la Cuenca del Plata – 2025
**Autor:** Alejandro Escallier
