# periodicity

=================

A project to represent the periodic table in various ways for various purposes.

Basically I'm playing around.

The current idea is to setup a client backend in PHP with Symfony, and store
the elements of the periodic table in Neo4j. I'll probably throw in some kind of
front end framework du jour like Vue to render the elements, and hopefully the
one cool thing I can do is write Cypher queries that form molecules from the
atoms.

## Getting Started

An easier way to get started with neo4j is Neo4j Desktop, with which this project is also compatible.

For Neo4j:

- Create a new database in neo4j, optionally named `periodicity`, using database version 3.4.\*.
  - At this writing, versions of Neo4j databases higher than 3.4.\* are incompatible with the Neo4jBundle drivers in the Symfony dependencies.
- Find the UUID. If you're using Neo4j Desktop you can find the database's UUID in the logs. Or check the error output when the seeder fails (see `For PHP`).
- Copy the `atoms/neo4j/periodic-table.csv` file to the database root directory.
  - On Linux, this will likely start in your home directory: `~/.config/Neo4j\ Desktop\Application\neo4jDatabases/database-{UUID}/installation-{major.minor.patch}/import/`
- Configure your neo4j.conf file to allow csv imports: `dbms.security.allow_csv_import_from_file_urls=true`

For PHP:

- From the project root, navigate your terminal to `php/symfony/periodicity`.
- Configure your Neo4j database connection in the `.env` file.
  - `NEO4J_DEFAULT_CONNECTION_DSN=bolt://neo4j:periodicity@localhost:7687` when the database is named `periodicity`. Update the port if you've configured it differently.
- In the terminal type `bin/console neo4j:fixtures:load` to seed the database.
  - If this fails, try checking the error output for the database root directory and move the `periodic-table.csv` file to it.
- Run installs from composer, npm, and install npm yarn: `npm install -g yarn`
  - The composer.json and .lock are set to the appropriate versions to work correctly with the OGM drivers available at this writing. Ignore deprecation warnings related to this.
- To build the front-end: `yarn encore dev`
- Run Symfony's local server: `bin/console server:start`. Navigate to: `http://127.0.0.1:8000/element` in your browser.
