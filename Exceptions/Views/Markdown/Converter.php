<?php namespace Exceptions\Views\Markdown;

use Exceptions\ExceptionInterface;

class Converter extends \Exception implements ExceptionInterface
{
    protected $message = 'Unhandled Markdown string';
    protected $code = 'MD101';
}