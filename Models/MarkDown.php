<?php namespace Models;

/**
 * TODO: create an abstraction and interface layer for future models
 */
class MarkDown
{
    /**
     * @var string
     */
    private $data;

    /**
     * @param string $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * return the next element in the array of data
     * @return string
     */
    public function getNextLine()
    {
        return fgets($this->data);
    }

    /**
     * close the file handle
     */
    public function __destruct()
    {
        /**
         * just in case it has not been closed
         */
        if ($this->data) {
            fclose($this->data);
        }
    }
}

