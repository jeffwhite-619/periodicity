# periodicity

=================

A project to represent the periodic table in various ways for various purposes.

Basically I'm playing around.

Initially, I've setup the client in PHP and Symfony. In the future, I'd like to do other clients
in Python, Rust or something else, and store the elements of the periodic table in Neo4j.

Later on, I'll probably throw in some kind of front end framework du jour like Vue to render the elements,
and hopefully the one cool thing I can do is write Cypher queries that form molecules from the
atoms.

## What Does This Thing Do?

To me, the cool stuff is in the Neo4j Browser app, in Neo4j Desktop. With the elements of the
periodic table in a graph database, we can do all kinds of things, mundane things, and see them in a
whole new way.

For example, this is what the table looks like when we look at several kinds of relationships to
categories, blocks, periods, etc.:

![alt text](https://github.com/jeffwhite-619/periodicity/blob/master/atoms/graphs/periodicity-blocks-categories.png?raw=true "Grouping elements by category and block")

![alt text](https://github.com/jeffwhite-619/periodicity/blob/master/atoms/graphs/periodicity-browser-transactinies-catalysis.png?raw=true "Grouping elements by category, block, transactinides and catalysis groups")

![alt text](https://github.com/jeffwhite-619/periodicity/blob/master/atoms/graphs/periodicity-browser-periods-stretched.png?raw=true "Grouping elements by category, block, period, transactinides and catalysis groups")

As for the web client, so far it's just a mundane thing seen in the usual, mundane way:

![alt text](https://github.com/jeffwhite-619/periodicity/blob/master/atoms/graphs/periodicity-element-page.png?raw=true "Element page")

## Getting Started

An easier way to get started with neo4j is Neo4j Desktop, with which this project is also compatible.

Dependencies:

- Neo4j or Neo4j Desktop
- npm, yarn, webpack
- symfony cli
- PHP 7.4.3, phpunit, composer

For Neo4j:

- Create a new database in neo4j, optionally named `periodicity`, using database version 3.4.\*.
  - At this writing, versions of Neo4j databases higher than 3.4.\* are incompatible with the Neo4jBundle drivers in the Symfony dependencies.
- Find the UUID. If you're using Neo4j Desktop you can find the database's UUID in the logs. Or check the error output when the seeder fails (see `For PHP`).
- Copy the `atoms/neo4j/periodic-table.csv` file to the database root directory.
  - On Linux, this will likely start in your home directory: `~/.config/Neo4j\ Desktop\Application\neo4jDatabases/database-{UUID}/installation-{major.minor.patch}/import/`
- Configure your neo4j.conf file to allow csv imports: `dbms.security.allow_csv_import_from_file_urls=true`
- If you're using Neo4j Desktop, enable Development Mode and run raw cypher queries in the Neo4j Browser

For PHP:

- From the project root, navigate your terminal to `php/symfony/periodicity`.
- Configure your Neo4j database connection in the `.env` file.
  - `NEO4J_DEFAULT_CONNECTION_DSN=bolt://neo4j:periodicity520@localhost:7687` when the database is named `periodicity`. Update the port if you've configured it differently.
- In the terminal type `bin/console neo4j:fixtures:load` to seed the database.
  - If this fails, try checking the error output for the database root directory and move the `periodic-table.csv` file to it.
- Run installs from composer, npm, and install npm libraries:
  - `composer install`
  - `npm i`
  - `npm install -g yarn webpack sass`
  - The composer.json and .lock are set to the appropriate versions to work correctly with the OGM drivers available at this writing. Ignore any deprecation warnings related to this.
- To build the front-end: `yarn encore dev`
- To run phpunit tests: `composer test`
- Run Symfony's local server: `bin/console server:start`. Navigate to: `http://127.0.0.1:8000/element` in your browser.
