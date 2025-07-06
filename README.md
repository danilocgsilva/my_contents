# Development environment

The database name must be `my_contents`.

The current setup environment is designed to run in a development setup. It uses the Apache2 as web server. Before starting the environment, don't you forget to:

1. Allow www-data user and group access the `storage` folder.
2. Ensure that the environment have a `.env`file available
3. The .env file have the entry for `APP_KEY`. If not, just run the artisan command: `php artisan key:generate`.

**Server:** For developmet, the application can run both served by Apache, or also using the Laravel server. Is the last case, run the `composer dev` command and use the port 8009.

**Frontend:** Builded with node and Vite.
