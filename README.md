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

- For PHP:
  - From the project root, navigate your terminal to php/symfony/periodicity.
  - Configure your database connection in the config/packages/neo4j.yaml file.
  - Configure your neo4j.conf file to allow csv imports: `dbms.security.allow_csv_import_from_file_urls=true`
  - In the terminal type `bin/console neo4j:fixtures:load`
