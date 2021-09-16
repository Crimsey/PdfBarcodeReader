# Reader for Barcodes from PDF files 
Based on Kevin Dunglas repo Symfony Docker, project to read barcodes from pdf.
Written in Symfony and OpenApi/Swagger.

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/)
2. Inside cloned repository use these two commands.
3. Run `docker-compose build --pull --no-cache` to build fresh images
4. Run `docker-compose up` (the logs will be displayed in the current shell)
5. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
6. Open `https://localhost/api/doc/extractpdfbarcode` and parse your PDF file in base64 format (just use online converter and parse string).
7. Remember to use "Try it out" button in POST panel.

## Features
* CI based on PHPUnit, PHP CS fixer, PHPStan

## Docs

1. [Build options](docs/build.md)
2. [Using Symfony Docker with an existing project](docs/existing-project.md)
3. [Support for extra services](docs/extra-services.md)
4. [Deploying in production](docs/production.md)
5. [Installing Xdebug](docs/xdebug.md)
6. [Troubleshooting](docs/troubleshooting.md)

## Credits
Based on project by [Kévin Dunglas](https://dunglas.fr), co-maintained by [Maxime Helias](https://twitter.com/maxhelias) and sponsored by [Les-Tilleuls.coop](https://les-tilleuls.coop).
