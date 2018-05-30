<?php

//todo: these should be loaded by an autoloading function

include './Loggers/Information.php';
include './Exceptions/ExceptionInterface.php';
include './Exceptions/Views/Markdown/Converter.php';
include './Exceptions/Input.php';
include './Exceptions/MissingFile.php';
include './Exceptions/Handler.php';
include './Views/MarkDown/Converter.php';
include './Models/MarkDown.php';
include './Controllers/Cli.php';
include './Controllers/Markdown/Converter.php';

$controller = Controllers\Markdown\Converter::factory($argv);

$controller->parse();