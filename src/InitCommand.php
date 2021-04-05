<?php

namespace devopsteam\modular;

use Cz\Git\GitRepository;
use Illuminate\Console\Command;

class InitCommand extends Command
{
    protected $signature = "modular:init";

    protected $name = "initialize command";

    var $project_path = __DIR__ . "/../../../../";
    var $modules_path = "inited in construct";

    public function __construct()
    {
        parent::__construct();
        $this->modules_path = $this->project_path . "/Modules";
    }

    private function getModules()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://gitlab.geevserver.com/arash/modular/-/raw/master/modules.json');
        if ($response->getStatusCode() == 200) {
        } else {
            $this->error("\ncannot fetch modules.\n");
            die("");
        }
        return  json_decode($response->getBody(), true);
    }

    private function cloneOrPull($name): bool
    {
        return file_exists($this->project_path . "/Modules/" . $name);
    }

    private function initModule($path, $name)
    {
        $this->line("getting \033[33m" . $name . "\033[37m from "  . $path . "...");

        if (!file_exists($this->modules_path)) {
            mkdir($this->modules_path);
        }

        // $this->line(scandir($this->project_path));
        $clone_or_pull = $this->cloneOrPull($name);
        $repo_path = $this->modules_path . "/" . $name;
        if ($clone_or_pull) {
            #exists , just pull updates
            $this->line("updating repository...");
            $repo = new GitRepository($repo_path);
            $repo->pull();
        } else {
            #need to clone
            $this->line("clonning repository...");
            $repo = GitRepository::cloneRepository($path, $repo_path);
        }
    }

    public function handle()
    {
        $this->line("fetching modules ...");
        $modules = $this->getModules();
        foreach ($modules as $module => $path) {
            $this->initModule($path, $module);
        }
    }
}
