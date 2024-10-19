# SECRET CHAT

## Prerequisites

Before you begin, ensure you have the following installed:

- [Git](https://git-scm.com/downloads)
- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Cloning the Repository

1. Open your terminal.
2. Clone the repository using the following command:

   ```bash
   git clone https://github.com/yourusername/your-repository.git
   ```

### Navigate into the project directory:
```bash
  cd your-repository
```
### Running Docker
```bash
  docker compose up --build
```
> copy .env.example into .env (you can use version in .env.example, it is working)


### Installing Dependencies Inside the Container
```bash
  docker compose exec app bash
```
### Install Composer dependencies inside container:
```bash
  composer install
```
### Install Node.js dependencies outside container:
```bash
  npm install
  npm run dev
```
### Run migrations to have db up to date:
```bash
  php artisan migrate
```
### Run jobs
```bash
  php artisan queue:work
```
### You can open project in browser via localhost
```
  http://localhost/
```

### You can open Mailhog in browser via
```
  http://localhost:8025/
```
