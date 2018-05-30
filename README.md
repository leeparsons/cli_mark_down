# cli_mark_down

Usage: from the command line run:

php markdownreader.php

*Optional Arguments*

file_path

for example:

php markdownreader.php path_to_markdown_file.md

## Output

The HTML file is created under: ./markdown.html

## Logs

Log information is written to a file in the location: ./cli_information.log

Errors and exceptions are written into a file in the location: ./cli_error.log

## TODO

* complete html markup with bold, unordered lists, ordered lists etc

* make the output file an optional input

* make the log file an optional input

* create unit tests

* complete interface and abstraction layers

* enforce interface type hints on objects passed through methods
