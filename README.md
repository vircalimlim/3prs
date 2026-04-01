# Laravel + Vue (Inertia) Project

## About

This project is built using Laravel for the backend and Vue.js with Inertia for the frontend.
The whole application is containerized using Docker, including the frontend (Node.js), backend (PHP), and database.

---

## Requirements

Make sure you have these installed:

* Docker
* Docker Compose

---

## Installation

1. Clone the repository:

```bash
git clone <your-repo-url>
cd <project-folder>
```

2. Copy the environment file:

```bash
cp .env.example .env
```

3. Start the containers:

```bash
docker-compose up -d --build
```

4. Install Laravel dependencies:

```bash
docker-compose exec app composer install
```

5. Generate app key:

```bash
docker-compose exec app php artisan key:generate
```

6. Run migrations:

```bash
docker-compose exec app php artisan migrate
```

---

## Running the App

* Laravel app: http://localhost:8000
* Vite dev server (frontend): http://localhost:5173

---

## Frontend (Vue + Vite)

The frontend runs inside a Node container.

To start it:

```bash
docker-compose up node
```

If needed, you can also run:

```bash
docker-compose exec node npm install
docker-compose exec node npm run dev
```

---

## Useful Commands

* Stop containers:

```bash
docker-compose down
```

* Rebuild containers:

```bash
docker-compose up -d --build
```

---

## Notes

* All services (PHP, Nginx, MySQL, Node) are running in separate containers.
* The project uses Vite for frontend asset bundling.
* Make sure ports `8000`, `5173`, and `3307` are available on your machine.

---
