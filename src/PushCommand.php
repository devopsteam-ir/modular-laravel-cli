<?php

namespace devopsteam\modular;

use Cz\Git\GitRepository;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class PushCommand extends Command
{
    protected $signature = "modular:push";
    var $project_path = __DIR__ . "/../../../../";
    var $modules_path = "inited in construct";

    public function __construct()
    {
        parent::__construct();
        $this->project_path = base_path();
        $this->modules_path = $this->project_path . "/Modules";
    }

    protected $name = "detect changes, and ask to push";
    private function getModules()
    {
        return scandir($this->modules_path);
    }

    private function cleanChangesText($text)
    {
        $cleaned_text = "";
        foreach ($text as $line) {
            if (Str::contains($line, 'added') || Str::contains($line, 'deleted') || Str::contains($line, 'modified')) {
                if (!Str::contains($line, 'changes added'))
                    $cleaned_text .= $line . "\n";
            }
        }
        return $cleaned_text;
    }
    private function checkCommit(string $path)
    {
        $repo_path = $this->modules_path . "/" . $path;
        $repo = new GitRepository($repo_path);
        $status = $repo->execute("status");
        $this->line($this->cleanChangesText($status));
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
            try {
                if ($path != "." && $path != "..") {
                    $this->checkModule($path);
                }
            } catch (Exception $err) {
                $this->error("cannot check " . $path);
            }
        }
    }
}
