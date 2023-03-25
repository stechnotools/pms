<?php namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

/**
 * Create an Module in HMVC
 *
 * @package App\Commands
 * @author Niranjan Sahoo
 */
class ModuleCreate extends BaseCommand
{
    /**
     * The group the command is lumped under
     * when listing commands.
     *
     * @var string
     */
    protected $group       = 'Development';

    /**
     * The Command's name
     *
     * @var string
     */
    protected $name        = 'module:create';

    /**
     * the Command's short description
     *
     * @var string
     */
    protected $description = 'Create CodeIgniter HMVC Modules in front folder';

    /**
     * the Command's usage
     *
     * @var string
     */
    protected $usage        = 'module:create [ModuleName] [Options]';

    /**
     * the Command's Arguments
     *
     * @var array
     */
    protected $arguments    = [ 'ModuleName' => 'Module name to be created' ];

    /**
     * the Command's Options
     *
     * @var array
     */
    protected $options      = [
        '-f' => 'Set module folder inside app path (default Modules)',
        '-v' => 'Set view folder inside app path (default front/module/Views)',
    ];

    /**
     * Parent Controller Name 
     */
	
	protected $parent_controller;
	
	/**
     * Module Name to be Created
     */
    protected $module_name;


    /**
     * Module folder (default /Modules)
     */
    protected $module_folder;


    /**
     * View folder (default /View)
     */
    protected $view_folder;


    /**
     * Run route:update CLI
     */
    public function run(array $params)
    {
		$forge = \Config\Database::forge();
		
		if ($this->forge->createTable('student')) {
			echo 'tab=le created!';
		}
		
		helper('inflector');

        $this->module_name = $params[0];

        if(!isset($this->module_name))
        {
            CLI::error("Module name must be set!");
            return;
        }

        $this->module_name = ucfirst($this->module_name);

        $module_folder         = $params['-f'] ?? CLI::getOption('f');
        
		$this->module_folder   = ucfirst($module_folder ?? 'front');
		
        if($this->module_folder=="Admin"){
			$this->parent_controller="AdminController";
		}else{
			$this->parent_controller="FrontController";
		}
        mkdir(ROOTPATH .  $this->module_folder . '/' . $this->module_name);

        try
        {
            $this->createConfig();
            $this->createController();
            $this->createModel();
			
            $this->createView();
			
            CLI::write('Module created!');
        }
        catch (\Exception $e)
        {
            CLI::error($e);
        }
    }

    /**
     * Create Config File
     */
    protected function createConfig()
    {
        $configPath = ROOTPATH .  $this->module_folder . '/' . $this->module_name . '/Config';
		
        mkdir($configPath);

        if (!file_exists($configPath . '/Routes.php'))
        {
            $routeName = strtolower($this->module_folder);
			$modulename = strtolower($this->module_name);
            $template = "<?php
if(!isset(\$routes))
{ 
    \$routes = \Config\Services::routes(true);
}
\$routes->group('$routeName', ['namespace' => '$this->module_folder\\$this->module_name\\Controllers'], function(\$subroutes){
	
	\$subroutes->add('$modulename', '$this->module_name::index');
});";

            file_put_contents($configPath . '/Routes.php', $template);
        }
        else
        {
            CLI::error("Can't Create Routes Config! Old File Exists!");
        }
    }

    /**
     * Create Controller File
     */
    protected function createController()
    {
        $controllerPath = ROOTPATH .  $this->module_folder . '/' . $this->module_name . '/Controllers';
		$view_name=strtolower($this->module_name);
        mkdir($controllerPath);

        if (!file_exists($controllerPath . '/'.$this->module_name.'.php'))
        {
            $template = "<?php 
namespace $this->module_folder\\$this->module_name\\Controllers;
use App\Controllers\\$this->parent_controller;
class $this->module_name extends $this->parent_controller
{
   
    /**
     * Constructor.
     */
    public function __construct()
    {
        
    }
    public function index()
	{
		\$data['title'] = 'Blank Page';
		return \$this->template->view('$this->module_folder\\$this->module_name\Views\\$view_name',\$data);
	}
}
";
            file_put_contents($controllerPath . '/'.$this->module_name .'.php', $template);
        }
        else
        {
            CLI::error("Can't Create Controller! Old File Exists!");
        }
    }

    
	/**
     * Create Models File
     */
    protected function createModel()
    {
        //$forge = \Config\Database::forge();
		
		$modelPath = ROOTPATH .  $this->module_folder . '/' . $this->module_name . '/Models';
		$model_name=strtolower($this->module_name);
        mkdir($modelPath);
		if (!file_exists($modelPath . '/'.$this->module_name.'.php')){
        $template = "<?php 
namespace $this->module_folder\\$this->module_name\\Models;
		
use CodeIgniter\Model;

class $this->module_name extends Model
{
    protected \$DBGroup          = 'default';
    protected \$table            = '$model_name';
    protected \$primaryKey       = 'id';
    protected \$useAutoIncrement = true;
    protected \$insertID         = 0;
    protected \$returnType       = object;
    protected \$useSoftDeletes   = false;
    protected \$protectFields    = true;
    protected \$allowedFields    = [];

    // Dates
    protected \$useTimestamps = false;
    protected \$dateFormat    = 'datetime';
    protected \$createdField  = 'created_at';
    protected \$updatedField  = 'updated_at';
    protected \$deletedField  = 'deleted_at';

    // Validation
    protected \$validationRules      = [];
    protected \$validationMessages   = [];
    protected \$skipValidation       = false;
    protected \$cleanValidationRules = true;

    // Callbacks
    protected \$allowCallbacks = true;
    protected \$beforeInsert   = [];
    protected \$afterInsert    = [];
    protected \$beforeUpdate   = [];
    protected \$afterUpdate    = [];
    protected \$beforeFind     = [];
    protected \$afterFind      = [];
    protected \$beforeDelete   = [];
    protected \$afterDelete    = [];
}";

            file_put_contents($modelPath . '/'.$this->module_name .'.php', $template);
        }
        else
        {
            CLI::error("Can't Create Model! Old File Exists!");
        }

        
    }

    /**
     * Create View
     */
    protected function createView()
    {
       $view_path = ROOTPATH . $this->module_folder . '/' . $this->module_name . '/Views';
		
        mkdir($view_path);

        if (!file_exists($view_path . '/dashboard.php'))
        {
            $template = '<section>
	<h1>Dashboard Page</h1>
    <table border=\"1px\">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach (\$data ?? [] as \$key => \$itemUser):?>
            <tr>
                <td><?=\$itemUser->getId() ?? "" ?></td>
                <td><?=\$itemUser->getName() ?? "" ?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
	<p>If you would like to edit this page you will find it located at:</p>
	<pre><code>app/Views/'. strtolower($this->module_name) .'/dashboard.php</code></pre>
	<p>The corresponding controller for this page can be found at:</p>
	<pre><code>app/Modules/'. $this->module_name .'/Controllers/Dashboard.php</code></pre>
</section>';

            file_put_contents($view_path . '/dashboard.php', $template);
        }
        else
        {
            CLI::error("Can't Create View! Old File Exists!");
        }

    }

}