<?php namespace Views\MarkDown;

use Loggers\Information;
use Models\MarkDown;

class Converter
{
    /**
     * @var MarkDown
     */
    private $model;

    private $viewFIle = './markdown.html';

    /**
     * Converter constructor.
     * @param MarkDown $model
     * @param null $viewFile
     * @param null $logger
     */
    public function __construct(MarkDown $model, $viewFile = null, $logger = null)
    {
        $this->model = $model;

        if (!is_null($viewFile)) {
            $this->viewFIle = $viewFile;
        }

        if (is_null($logger)) {
            $logger = new Information;
        }

        $this->logger = $logger;
    }

    /**
     * This will usually export whatever data is required to the view.
     * In this case I have chosen to output the view into a file
     */
    public function makeViewData()
    {
        $fileHandle = fopen($this->viewFIle, 'w');

        fputs($fileHandle, '<!DOCTYPE html><html><body>');

        while (false !== ($line = $this->model->getNextLine())) {

            $html = $this->convertLineToHtml(trim($line));
            if (false === $html) {
                continue;
            }
            fputs($fileHandle, $html);
            fputs($fileHandle, "\n\r");
        }

        fputs($fileHandle, '</body></html>');

        fclose($fileHandle);
    }

    /**
     * @param $string
     * @return bool|string
     * @throws \Exceptions\Views\Markdown\Converter
     */
    private function convertLineToHtml($string)
    {
        if ($string == "") {
            return "<br>";
        }

        $makeItalic = false;
        $countOfHashes = substr_count($string, '#');

        $html = [];

        if (substr($string, 0, 1) == '*' && substr($string, -1, 1) == '*') {
            $makeItalic = true;
        }

        /**
         * transfer this into a method to make start tag
         */
        if ($countOfHashes > 0) {
            $html[] = "<h$countOfHashes>";
        } else {
            $html[] = "<p>";
        }

        if ($makeItalic) {
            $html[] = "<i>";
        }

        /**
         * end start tag logic
         */


        $html[] = $string;



        /**
         * transfer this into a method to make end tag
         */
        if ($makeItalic) {
            $html[] = "</i>";
        }

        if ($countOfHashes > 0) {
            $html[] = "</h$countOfHashes>";
        } else {
            $html[] = "</p>";
        }

        /**
         * end end tag logic
         */

        return implode("", $html);
    }
}

