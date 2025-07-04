# Laravel Product Search App Using Docker-compose

This is a Laravel-based web application packaged with Docker using Docker Compose. It features a searchable, table-like UI to browse and filter products.

## 🚀 Features

- Dockerized Laravel environment (PHP, Nginx, MySQL)
- Searchable product table at `/productSearch` using livewire/tailwind`
- Artisan-powered testing suite

---

## 🐳 Getting Started

### Prerequisites

Make sure you have the following installed:

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

---

## ⚙️ Setup Steps

## Clone the repository:

   ```bash
   git clone https://github.com/Coding-Challenger/testFilter.git
   cd testFilter
   ```

## Copy .env file...

    bash
    cp .env.example .env
    
    
# Build and start the containers..

    docker-compose up -d --build

## INstall the dependencies and generate the app key
    docker-compose exec app composer install
    docker-compose exec app php artisan key:generate


## Run the database migrations and seeders

``
    docker-compose exec app php artisan migrate --seed
``
## Install the nodejs dependencies

    docker run --rm -it --user 1000 -v ${PWD}:/var/www -w /var/www node:20-alpine npm install
    docker run --rm -it --user 1000 -v ${PWD}:/var/www -w /var/www node:20-alpine npm run build


## Now we can test it...

Lets go to the

[http://localhost:8051/productSearch](http://localhost:8051/productSearch)

## Run the tests, just go to your terminal..

    docker exec -it app php artisan test
