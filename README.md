# Instalación del Proyecto con Docker

Este documento describe los pasos para instalar y ejecutar el proyecto utilizando Docker.

## Requisitos previos

Asegúrate de tener instalado Docker en tu sistema antes de continuar. Puedes descargar Docker desde el sitio web oficial:

- [Docker Website](https://www.docker.com/get-started)

## Pasos de instalación

1. ejecutar el siguiente comando para clonar el repositorio:

```bash
composer install && npm install
```

2. Ejcutar para montar docker

```bash
docker-compose up -d
```

3. Ejcutar para crear la base de datos

```bash
php artisan migrate --seed
```

4. abre el sistema

```bash
   php artisan serve
   ```

```bash
 npm run dev
```
   
