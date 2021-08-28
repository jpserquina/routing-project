# routing-project
* a project that implements a routing class in a barebones MVC scaffold
* requires PHP 7.4 (uses the spread operator and type declarations)
* with PSR-4 (autoloading)
* RESTful endpoints
* configurable routes
* endpoints require Basic auth payload
* includes PHPUnit tests

## Prerequisites
* Docker and `docker-compose`

## Setting up
* `$ docker-compose build`
* `$ docker-compose up -d`
* `$ docker-compose exec app composer install`
* (when done) `$ docker-compose down`

## Tests
* Tests are located under `~/routing-project/tests/RouteTest.php`, and include all the test cases provided below.

## Notes
From here, the following are needed to turn this into a live application
* Schema, migrations, and persisting model data
* Adding a views handler / renderer (MVC), or a JSON-contract handler for a headless project
* Middleware for better auth, CSRF, and injection mitigation

---

Using modern PHP (think PHP7, composer, autoloading, PSR-4, and best practices) please create a "Routing Class" as defined below.

A routing class is designed to take a url segment and automatically invoke a controller class. It does this by breaking up the url segments that come
in a predictable pattern and invoking the correct class and method and inserting parameters into the method invoked. We will be following
a REST-ful convention and be using common http methods. Your Routing class will be aware of the http method and the actual url segment.

Here is the complete requirement. These tables represents all possible routing logic.

## Unnested routes 

| Method | Segment      | Controller class name | Controller method name | Parameters                                                      |
| ------ | ------------ | --------------------- | ---------------------- | --------------------------------------------------------------- |
| GET    | /patients    | PatientsController    | index                  | none                                                            |
| GET    | /patients/2  | PatientsController    | get                    | this should invoke `get($patientId)` where $patientId = 2       |
| POST   | /patients    | PatientsController    | create                 | none (extra credit for handling the request body)               |
| PATCH  | /patients/2  | PatientsController    | update                 | `update($patientId)`                                            |       
| DELETE | /patients/2  | PatientsController    | delete                 | `delete($patientId)`                                            |


## Nested routes

| Method | Segment                    | Controller class name         | Controller method name | Parameters                                  |
|------- | -------------------------- | ----------------------------- | ---------------------- | ------------------------------------------- |
| GET    | /patients/2/metrics        | PatientsMetricsController     | index                  | `index($patientId)`                         |
| GET    | /patients/2/metrics/abc    | PatientsMetricsController     | get                    | `get($patientId, $metricId)`                |
| POST   | /patients/2/metrics        | PatientsMetricsController     | create                 | `create($patientId)`                        |
| PATCH  | /patients/2/metrics/abc    | PatientsMetricsController     | update                 | `update($patientId, $metricId)`             |       
| DELETE | /patients/2/metrics/abc    | PatientsMetricsController     | delete                 | `delete($patientId, $metricId)`             |




To invoke the Routing class we'll be calling it statically. For example we'll be defining a `routes.php` that looks like this


```
Route::resource('patients');
Route::resource('patients.metrics');
```
