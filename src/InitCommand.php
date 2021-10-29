<?php

    namespace devopsteam\modular;

    use CzProject\GitPhp\GitRepository;
    use Illuminate\Console\Command;

    class InitCommand extends Command
    {
        var $project_path = __DIR__ . "/../../../../";
        var $modules_path = "inited in construct";
        protected $signature = "modular:init";
        protected $name = "initialize command";

        public function __construct()
        {
            parent::__construct();
            $this->modules_path = $this->project_path . "/Modules";
        }

        public function handle()
        {
            $this->line( "fetching modules ..." );
            $modules = $this->getModules();
            foreach ( $modules as $module => $path )
            {
                $this->initModule( $path, $module );
            }
        }

        private function getModules()
        {
            $client = new \GuzzleHttp\Client();
            $response = $client->request( 'GET', 'https://gitlab.geevserver.com/arash/modular/-/raw/master/modules.json' );
            if ( $response->getStatusCode() == 200 )
            {
            }
            else
            {
                $this->error( "\ncannot fetch modules.\n" );
                die( "" );
            }
            return json_decode( $response->getBody(), true );
        }

        private function initModule( $path, $name )
        {
            $this->line( "getting \033[33m" . $name . "\033[37m from " . $path . "..." );

            if ( !file_exists( $this->modules_path ) )
            {
                if ( !mkdir( $concurrentDirectory = $this->modules_path ) && !is_dir( $concurrentDirectory ) )
                {
                    throw new \RuntimeException( sprintf( 'Directory "%s" was not created', $concurrentDirectory ) );
                }
            }

            // $this->line(scandir($this->project_path));
            $repo_path = $this->modules_path . "/" . $name;
            $this->line( "updating repository..." );
            $repo = new GitRepository( $repo_path );
            $repo->pull();
        }

        private function cloneOrPull( $name ) : bool
        {
            return file_exists( $this->project_path . "/Modules/" . $name );
        }
    }
