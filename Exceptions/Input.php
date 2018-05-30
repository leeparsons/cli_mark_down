<?php namespace Exceptions;

class Input extends \Exception implements ExceptionInterface
{
    protected $message = 'Please supply the file name as the first argument';
    protected $code = 'Input101';
}