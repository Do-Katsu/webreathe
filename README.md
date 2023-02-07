# Webreathe IoT Monitoring

This project is a technical test aimed at evaluating programming skills. The objective of this test is to develop a web-based IoT module monitoring system.

## Technologies

- HTML
- CSS
- PHP
- Bootstrap
- Javascript
- MySQL
- Symfony (or Laravel)
- JavaScript libraries (allowed but not frameworks)

## Criteria

The following criteria will be considered when evaluating this project:

- Adherence to instructions
- Quality of code (logic, organization, comments)
- Tools used
- Ease of implementation
- Design and any additional features

## Requirements

- npm
- PHP 7.2 or higher
- Composer
- A web server (e.g. Apache or Nginx)

## Installation

1. Clone the repository to your local machine

```
shell
$ git clone https://github.com/Do-Katsu/webreathe.git
```

1. Navigate to the project directory

```
shell
$ cd webreathe
```

1. Install the dependencies using Composer

```
ruby
$ composer install
```

1. Configure the environment variables in the .env file

```
shell
$ nano .env
```

1. Create the database using Doctrine migrations

```
shell
$ bin/console doctrine:database:create
$ bin/console doctrine:migrations:migrate
```

1. Load the fixtures (optional)

```
shell
$ bin/console doctrine:fixtures:load
```

1. Start the local web server

```
ruby
$ symfony server:start
```

1. Access the application in your web browser at http://localhost:8000

## Contributing

Contributions are welcome and appreciated. To contribute, fork the repository, make your changes and submit a pull request.
