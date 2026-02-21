# Development environment

The database name must be `my_contents`.

The current setup environment is designed to run in a development setup. It uses the Apache2 as web server. 
Firts, build the environment with docker compose.
Then, before starting the environment, don't you forget to:

1. Allow www-data user and group access the `storage` folder.
2. Ensure that the environment have a `.env`file available
3. The .env file have the entry for `APP_KEY`. If not, just run the artisan command: `php artisan key:generate`.

**Server:** For developmet, the application can run both served by Apache, or also using the Laravel server. Is the last case, run the `composer dev` command and use the port 8009.

In the root folder, you can find `start_server.sh` file. It works in Mac or Linux (not in Windows). Just make it executable and run to automacally start the development server. *Notice* the it assumes that the environment already has been built with Docker.

**Frontend:** Builded with node and Vite.

## Tests

The application already ship with a `.env.testing` environment file. Then, you also must assure that your development environment have a database called `my_contents_test` (or whatever you want, if `.env.testing` is changed).
To make tests works, the front must be builded. You can just keep the development server running before running tests. Just ensure that you run `composer dev` before running tests.

## Architecture

The most generic entity in the application is the *Content*. Actually, its table is just one column, having the *content* id.

All other information about the content is stored in the *Meta* data.

This way allows the greatest flexibility for content data. Thus, not the most performant, as consuming the content data always means making a cross table query (*joins*), but the design was the one to allow the gratest flexibility.

## Content Metadata

Each *Metadata* entry belongs to a *Content*. Several metadata can belongs to the content.
