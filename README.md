# Requirements
- Docker
- Docker Compose

# Setup
Run bellow command int project's root directory to download and build required docker images:

`./vendor/bin/sail up`

After setup completed set connection information for database in `.env` file including these parameters:
`DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`

The api base url will be `http://localhost` by default.

# API documentation
https://documenter.getpostman.com/view/3236050/UVknubvP
