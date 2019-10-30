<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\ProcessUtils;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\PhpExecutableFinder;

class TelstarServeAndWatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'command:name';
    // protected $signature = 'command:serve {--host=127.0.0.1} {--port=8000}';
    protected $signature = 'telstar:watch {--host=127.0.0.1} {--port=8000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        chdir($this->laravel->publicPath());
        // $this->line("<info>\n\nKick-Ass TELSTAR development server started at: \n\n  HOST={$this->host()} \n  PORT={$this->port()}\n\n  Command-click ==></info> http://{$this->host()}:{$this->port()}");
        // $this->line("<info>\n\nKick-Ass TELSTAR development server started at: \n\n  HOST={$this->host()} \n  PORT={$this->port()}\n\n  Command-click</info> http://{$this->host()}:{$this->port()}<info> to serve in browser.</info>");
        $this->line("<info>\n\nKick-Ass TELSTAR development server started at: \n\n  HOST={$this->host()} \n  PORT={$this->port()}\n\n  Command-click to serve --></info> http://{$this->host()}:{$this->port()}");
        passthru($this->serverCommand());
    }

    protected function serverCommand()
    {
        return sprintf(
            '%s -S %s:%s %s/server.ph %s',
            ProcessUtils::escapeArgument((new PhpExecutableFinder)->find(false)),
            $this->host(),
            $this->port(),
            ProcessUtils::escapeArgument($this->laravel->basePath()),
			' && yarn watch'
        );
    }

    /**
     * Get the host for the command.
     *
     * @return string
     */
    protected function host()
    {
        // return env('APP_HTTP_HOST') != "" ?  env('APP_HTTP_HOST') : $this->input->getOption('host');
        return env('TELSTAR_LOCAL_HOST') != "" ?  env('TELSTAR_LOCAL_HOST') : $this->input->getOption('host');
    }
    /**
     * Get the port for the command.
     *
     * @return string
     */
    protected function port()
    {
        // return env('APP_HTTP_PORT') != "" ?  env('APP_HTTP_PORT') : $this->input->getOption('port');
        return env('TELSTAR_LOCAL_PORT') != "" ?  env('TELSTAR_LOCAL_PORT') : $this->input->getOption('port');
    }
}