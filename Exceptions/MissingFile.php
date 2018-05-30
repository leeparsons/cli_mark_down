<?php namespace Exceptions;

class MissingFile extends \Exception implements ExceptionInterface
{
    protected $message = 'The file path is incorrect or the file is missing';
    protected $code = 'Input102';
}