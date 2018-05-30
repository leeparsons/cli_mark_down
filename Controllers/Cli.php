<?php namespace Controllers;

use Loggers\Information;
use Models\MarkDown;

abstract class Cli
{
    const ERROR_LOG = './cli_error.log';

    /**
     * @var Information
     */
    protected $logger;

    /**
     * TODO: interface should be used here (change if get time)
     * @var MarkDown
     */
    protected $model;

    /**
     * Cli constructor.
     * @param array $argv
     */
    protected function __construct(array $argv = [])
    {
        ini_set("log_errors", 1);
        ini_set("error_log", self::ERROR_LOG);
        set_exception_handler([new \Exceptions\Handler, "log"]);

        $this->logger = new Information;

        $this->logger->log("Constructed " . get_class($this));

        $this->makeModel();
        $this->makeView();
    }

    /**
     * @param array $argv
     * @return static
     */
    public static function factory(array $argv = [])
    {
        $obj = new static($argv);

        $obj->logger->log('Running sanity check on argv inputs');

        $obj->sanityCheckInputs();

        $obj->makeModel();

        $obj->loadDataIntoModel();

        $obj->makeView();

        return $obj;
    }

    /**
     * checks the inputs for expected values and should throw exception when they are missing
     */
    protected function sanityCheckInputs() {}

    /**
     * does whatever action is required
     */
    public function parse()
    {
        $this->logger->log("Beginning to make view data");
        $this->view->makeViewData($this->model);
    }

    /**
     * sets up the model per class
     */
    abstract public function makeModel();

    /**
     * set up the view object per class
     */
    abstract public function makeView();

    abstract public function loadDataIntoModel();
}