<?php

namespace devopsteam\modular;

use Cz\Git\GitRepository;
use Illuminate\Console\Command;

class PushCommand extends Command
{
    protected $signature = "modular:push";
    var $project_path = __DIR__ . "/../../../../";
    var $modules_path = "inited in construct";

    public function __construct()
    {
        parent::__construct();
        $this->modules_path = $this->project_path . "/Modules";
    }

    protected $name = "detect changes, and ask to push";
    private function getModules()
    {
        return scandir($this->modules_path);
    }
    private function checkCommit(string $path)
    {
        $repo_path = $this->modules_path . "/" . $path;
        $repo = new GitRepository($repo_path);
        $should_commit = $this->confirm('Commit Changes?');
        if ($should_commit) {
            $repo->addAllChanges();
            $commit_message = $this->ask('Commit Message?');
            $repo->commit($commit_message);
            $should_push = $this->confirm('Push Changes?');
            if ($should_push) {
                $repo->push();
            }
        }
    }
    private function checkModule(string $path)
    {
        $repo_path = $this->modules_path . "/" . $path;
        $repo = new GitRepository($repo_path);
        if ($repo->hasChanges()) {
            $this->line("detected changes on " . $path . " module");
            $this->checkCommit($path);
        }
    }

    public function handle()
    {
        $modules = $this->getModules();
        foreach ($modules as $path) {
            if ($path != "." && $path != "..")
                $this->checkModule($path);
        }
    }
}
