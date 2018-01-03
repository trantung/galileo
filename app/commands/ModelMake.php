<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ModelMake extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'model:make';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new Model';

	protected $generator;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->generator = new ModelGenerator;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->generateModel();
		return 'Hi guy!';
	}

	/**
	 * Generate a new question-type system file.
	 *
	 * @return void
	 */
	protected function generateModel()
	{
		// Once we have the controller and resource that we are going to be generating
		// we will grab the path and options. We allow the developers to include or
		// exclude given methods from the resourceful controllers we're building.
		$name = $this->argument('name');
		$table = $this->option('table');
		$table = !empty($table) ? $this->option('table') : $name;

		// Finally, we're ready to generate the actual controller file on disk and let
		// the developer start using it. The controller will be stored in the right
		// place based on the namespace of this controller specified by commands.
		if(!$this->generator->make($name, $table)){
			$this->error('Fail! Model exists.');
			return false;
		}

		$this->info("Model '$name' has been created!");
		$this->call('optimize');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('name', InputArgument::REQUIRED, 'The name of Model.'),
			array('table', InputArgument::OPTIONAL, 'The name of your table.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('name', null, InputOption::VALUE_OPTIONAL, 'The name of Model.', null),
			array('table', null, InputOption::VALUE_REQUIRED, 'The name of your table.', ''),
		);
	}

}
