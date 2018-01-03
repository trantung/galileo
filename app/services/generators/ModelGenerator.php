<?php
use Illuminate\Filesystem\Filesystem;

class ModelGenerator {

	/**
	 * The filesystem instance.
	 *
	 * @var \Illuminate\Filesystem\Filesystem
	 */
	protected $files;

	/**
	 * The default resource controller methods.
	 *
	 * @var array
	 */
	protected $defaults = array(
		'getModelName',
		'getTableName',
	);

	/**
	 * Create a new controller generator instance.
	 *
	 * @param  \Illuminate\Filesystem\Filesystem  $files
	 * @return void
	 */
	public function __construct()
	{
		$this->files = new Filesystem;
	}

	/**
	 * Create a new resourceful controller file.
	 *
	 * @param  string  $controller
	 * @param  string  $path
	 * @param  array   $options
	 * @return void
	 */
	public function make($name, $desc)
	{
		//////// Add service file services/questions/{name}.php
		$stubService = $this->getServiceQuestionType($name, $desc);
		$servicePath = app_path().'/models';
		$addService = $this->writeFile($stubService, $name, $servicePath);
		if(!$addService){
			return false;
		}

		return true;
	}

	/**
	 * Write the completed stub to disk.
	 *
	 * @param  string  $stub
	 * @param  string  $controller
	 * @param  string  $path
	 * @return void
	 */
	protected function writeFile($stub, $name, $path)
	{
		$name = str_replace('\\', DIRECTORY_SEPARATOR, $name);

		if ( ! $this->files->exists($fullPath = $path."/{$name}.php"))
		{
			return $this->files->put($fullPath, $stub);
		}
		return false;
	}

	/**
	 * Create the directory for the controller.
	 *
	 * @param  string  $controller
	 * @param  string  $path
	 * @return void
	 */
	protected function makeDirectory($path)
	{
		if ( ! $this->files->isDirectory($path) )
		{
			$this->files->makeDirectory($path, 0777, true);
		}
	}

	/**
	 * Get the controller class stub.
	 *
	 * @param  string  $controller
	 * @return string
	 */
	protected function getServiceQuestionType($name, $table = '')
	{
		$stub = $this->files->get(__DIR__.'/model.stub');
		$stub =  str_replace('{{class}}', $name, $stub);
		return str_replace('{{table}}', $table, $stub);
	}

}
