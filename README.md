## Simple Api

Simple Api in Laravel 8
## Installation

Requirements

- php 8
- mysql
- docker

### Run application

In root directory run:
```
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'

sail up
```

To run test:
```
sail php artisan test
```

Run migration and seeds
```
sail php artisan migrate:fresh --seed
```

## Api getting with Curl

### Bloods

Show all bloods

```
curl -H 'content-type: application/json' -H 'Accept: application/json' -v -X GET http://127.0.0.1/api/bloods
```

Show blood of id 2

```
curl -H 'content-type: application/json' -H 'Accept: application/json' -v -X GET http://127.0.0.1/api/bloods/2
```

Create blood

```
curl -H 'content-type: application/json' -H 'Accept: application/json' -v -X POST -d '{"title":"Glukoza", "code": "10", "codeICD": "L43", "categories_id": {1, 2}}' http://127.0.0.1/api/bloods
```

Update blood of id 4

```
curl -H 'content-type: application/json' -H 'Accept: application/json' -v -X PUT -d '{"title":"Insulina", "code": "153", "codeICD": "L97"}' http://127.0.0.1/api/bloods/3
```
### Categories

Show all categories 

```
curl -H 'content-type: application/json' -H 'Accept: application/json' -v -X GET http://127.0.0.1/api/categories
```

Show category of id 2

```
curl -H 'content-type: application/json' -H 'Accept: application/json' -v -X GET http://127.0.0.1/api/categories/2
```

Create category

```
curl -H 'content-type: application/json' -H 'Accept: application/json' -v -X POST -d '{"title":"Ciąża"}' http://127.0.0.1/api/categories
```

Update category of id 4

```
curl -H 'content-type: application/json' -H 'Accept: application/json' -v -X PUT -d '{"title":"Ciąża Updated"}' http://127.0.0.1/api/categories/4
```
