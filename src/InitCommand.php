<?php

namespace devopsteam\modular;

use CzProject\GitPhp\Git;
use Illuminate\Console\Command;

class InitCommand extends Command
{
    var       $project_path = __DIR__ . "/../../../../";
    var       $modules_path = "inited in construct";
    protected $signature    = "modular:init";
    protected $name         = "initialize command";
    var       $version      = 1;

    public function __construct()
    {
        parent::__construct();
        $this->modules_path = $this->project_path . "/Modules";
    }

    public function handle()
    {
        $this->line( 'Dyneema Framework Helper v' . $this->version );
        $this->line( "fetching modules ..." );
        $modules = $this->getModules();
        $this->line(
            'fetched ' . implode(
                ', ' , array_map( function ( $module_git )
                     {
                         return str_replace( '.git' , '' , last( explode( '/' , $module_git ) ) );
                     } , $modules )
            )
        );
        $this->newLine( 1 );
        $index = 0;
        $total = count( $modules );
        foreach ( $modules as $module => $path )
        {
            $index++;
            $this->initModule( $path , $module , $index , $total );
        }
    }

    private function getModules()
    {
        $client   = new \GuzzleHttp\Client();
        $response = $client->request( 'GET' , 'https://gitlab.geevserver.com/arash/modular/-/raw/master/modules.json' );
        if ( $response->getStatusCode() == 200 )
        {
        }
        else
        {
            $this->error( "\ncannot fetch modules.\n" );
            die( "" );
        }
        return json_decode( $response->getBody() , true );
    }

    private function initModule( $path , $name , $index , $total )
    {
        $this->line( "\033[0;97m[ " . $index . "/" . $total . " ] getting \033[93m" . $name );

        if ( !file_exists( $this->modules_path ) )
        {
            if ( !mkdir( $concurrentDirectory = $this->modules_path ) && !is_dir( $concurrentDirectory ) )
            {
                throw new \RuntimeException( sprintf( 'Directory "%s" was not created' , $concurrentDirectory ) );
            }
        }

        $git       = new Git();
        $repo_path = $this->modules_path . "/" . $name;
        if ( $this->cloneOrPull( $name ) )
        {
            $repo = $git->open( $repo_path );
            $this->line( "  \033[92m -> " . $repo->getLastCommit()->getSubject() . ' from ' . $repo->getLastCommit()->getCommitterName() );
            $repo->pull();
        }
        else
        {
            $this->line( "cloning repository..." . $path );
            $repo = $git->cloneRepository( $path , $repo_path );
        }
    }

    private function cloneOrPull( $name ): bool
    {
        return file_exists( $this->project_path . "/Modules/" . $name );
    }
}
