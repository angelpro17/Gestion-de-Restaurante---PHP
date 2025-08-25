# 🍽️ Sistema de Gestión de Restaurante

<p align="center">
    <img src="https://img.shields.io/badge/Laravel-11-red" alt="Laravel 11">
    <img src="https://img.shields.io/badge/PHP-8.2+-blue" alt="PHP 8.2+">
    <img src="https://img.shields.io/badge/Tailwind-CSS-38B2AC" alt="Tailwind CSS">
</p>

## 📋 Descripción

Sistema de gestión integral para restaurantes desarrollado con Laravel 11. Permite la administración de productos del menú, gestión de usuarios con roles específicos (administrador/empleado), y un dashboard personalizado según el tipo de usuario.

## ✨ Características

### 👨‍💼 Para Administradores
- ✅ Gestión completa de productos del menú
- ✅ Administración de usuarios y empleados
- ✅ Dashboard con estadísticas del restaurante
- ✅ Reportes y métricas
- ✅ Control total del sistema

### 👨‍🍳 Para Empleados
- ✅ Consulta del menú disponible
- ✅ Filtros por categoría y disponibilidad
- ✅ Gestión de perfil personal
- ✅ Dashboard informativo

## 🚀 Instalación

1. **Clonar el repositorio**
```bash
git clone [url-del-repositorio]
cd restaurante
```

2. **Instalar dependencias**
```bash
composer install
npm install
```

3. **Configurar el entorno**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configurar la base de datos**
- Editar el archivo `.env` con los datos de tu base de datos
- Ejecutar las migraciones:
```bash
php artisan migrate
php artisan db:seed
```

5. **Compilar assets**
```bash
npm run build
# o para desarrollo:
npm run dev
```

6. **Iniciar el servidor**
```bash
php artisan serve
```

## 🔧 Tecnologías Utilizadas

- **Backend**: Laravel 11
- **Frontend**: Blade Templates + Tailwind CSS
- **JavaScript**: Alpine.js
- **Base de Datos**: MySQL/SQLite
- **Autenticación**: Laravel Breeze
- **Build Tool**: Vite

## 👥 Roles de Usuario

### Administrador
- Acceso completo al sistema
- Gestión de productos y usuarios
- Visualización de reportes

### Empleado
- Acceso limitado al menú
- Consulta de productos disponibles
- Gestión de perfil personal

## 📱 Funcionalidades

- **Sistema de autenticación** con roles
- **CRUD completo** de productos
- **Gestión de usuarios** con diferentes permisos
- **Dashboard personalizado** según el rol
- **Filtros avanzados** en listados
- **Interfaz responsive** con Tailwind CSS
- **Middleware de seguridad** para protección de rutas

## 🛡️ Seguridad

- Middleware de autenticación
- Middleware de roles personalizados
- Protección CSRF
- Validación de formularios
- Sanitización de datos

## 📄 Licencia

Este proyecto está bajo la Licencia MIT.

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Por favor, abre un issue primero para discutir los cambios que te gustaría realizar.

---

**Desarrollado con ❤️ para la gestión eficiente de restaurantes**# Gestion-de-Restaurante---PHP
