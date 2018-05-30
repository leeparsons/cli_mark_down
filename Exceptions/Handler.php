<?php namespace Exceptions;

class Handler
{
    public function log(ExceptionInterface $error)
    {
        /**
         * todo: configure message type on exception class
         */
        error_log($error->getMessage() . ' on  line: ' . $error->getLine() . ' in file: ' . $error->getFile());

        echo 'An error occured. Information is recorded in: ' . ini_get('error_log') . ' at: ' . (new \DateTime())->format("Y-m-d H:i:s") . "\n\r";
    }
}

