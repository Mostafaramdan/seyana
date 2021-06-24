<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Commands\contentVue\modueControllerContent;
use Illuminate\Support\Str;

class nmoduleVue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nmoduleVue:go {moduleName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command used to create new module of view , resource route , all views with vue';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $moduleName=$this->argument('moduleName');
        $blades =['create','index','show','update'];
        $folderPath="app/Http/Controllers/dashboard/";
        $bladePath="resources/views/js/pages/".$moduleName."/";
        if (!file_exists( $folderPath))
            mkdir( $folderPath, 0777, true);

        if (!file_exists( $bladePath))
            mkdir( $bladePath, 0777, true);


        //create Controller
        $path =$moduleName.'.php' ;
        $file = fopen( $folderPath.$path, "wb") ;
        $contents = file_get_contents('controller.php');
        file_put_contents($folderPath.$path, Str::replace('fileName',$moduleName,$contents) );
        fclose($file);

        // foreach($blades as $blade ){
        //     $path =$blade.'.vue';
        //     $file = fopen( $bladePath.$path, "wb") ;
        //     file_put_contents($bladePath.$path, modueControllerContent::{$blade}($moduleName));
        //     fclose($file);
        // }

        $myfile = fopen("routes/dashboard.php", "a") or die("Unable to open file!");
        $txt = "\n route::post('{$moduleName}/createUpdate','{$moduleName}@createUpdate')->name('dashboard.{$moduleName}.createUpdate');";
        fwrite($myfile, "\n". $txt);
        fclose($myfile);
        $this->info("create module of {$moduleName} successfully by mostafa ramdan");

    }
}
