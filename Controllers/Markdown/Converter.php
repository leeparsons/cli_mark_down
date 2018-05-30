<?php namespace Controllers\Markdown;

use Controllers\Cli;
use Exceptions\Input;
use Exceptions\MissingFile;
use Models\MarkDown;
use Views\MarkDown\Converter as ConverterView;

class Converter extends Cli
{
    const ERROR_LOG = './markdown_converter.log';

    /**
     * @var null|string
     */
    private $pathToMarkDownFile;

    /**
     * optional: path to the file which the converted markup HTML will be placed into
     * @var null|string
     */
    private $viewFile;

    /**
     * Converter constructor.
     * @param array $argv
     * @throws Input
     */
    protected function __construct(array $argv = [])
    {
        parent::__construct($argv);

        if (!isset($argv[1])) {
            throw new Input();
        }

        if (isset($argv[2])) {
            $this->viewFile = $argv[2];
        }

        $this->pathToMarkDownFile = $argv[1];
    }

    protected function sanityCheckInputs()
    {
        if (!file_exists($this->pathToMarkDownFile)) {
            throw new MissingFile();
        }
    }

    public function makeModel()
    {
        $this->logger->log("Making Model Object");
        $this->model = new MarkDown();
    }

    public function loadDataIntoModel()
    {
        $this->logger->log("Loading markdown into model");

        $fileReadHandle = fopen($this->pathToMarkDownFile, "r");

        $this->model->setData($fileReadHandle);
    }

    public function makeView()
    {
        $this->logger->log("Making View Object");
        $this->view = new ConverterView($this->model, $this->viewFile);
    }
}

