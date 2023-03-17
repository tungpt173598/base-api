<?php

namespace Tungpt\Base;

use Illuminate\Console\GeneratorCommand;

class ServiceMakeCommand extends GeneratorCommand
{
    protected $name = 'make:service';

    protected $description = 'Create a new service';

    protected function getStub()
    {
        return __DIR__ .  '/stubs/service.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Services';
    }


    public function handle()
    {
        parent::handle();
        $this->createController();
    }

    protected function createController()
    {
        // Get the fully qualified class name (FQN)
        $class = $this->qualifyClass($this->getNameInput());

        // get the destination path, based on the default namespace
        $path = $this->getPath($class);

        $content = file_get_contents($path);

        // Update the file content with additional data (regular expressions)

        file_put_contents($path, $content);
    }

    public function fire()
    {
        $this->info('Make TController successfully');
    }
}
