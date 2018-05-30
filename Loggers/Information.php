<?php namespace Loggers;

/**
 *
 * Note: keep this flexible by design to allow for extension on information class in future with different log paths
 *
 */

class Information
{
    const LOG_PATH = './cli_information.log';

    /**
     * @param $informationMessage
     */
    public function log($informationMessage)
    {
        $errorMessage = [];

        $errorMessage[] = (new \DateTime())->format("Y-m-d H:i:s");

        $errorMessage[] = $informationMessage;

        $errorMessage[] = "\n\r";

        error_log(
            implode(' ', $errorMessage), 3, static::LOG_PATH);
    }
}

