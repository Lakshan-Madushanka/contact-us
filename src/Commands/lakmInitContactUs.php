<?php

namespace Lakm\Contact\Commands;

use Illuminate\Console\Command;

class lakmInitContactUs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lakm:InitContactUs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize all requirements to run the package';

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
     * @return int
     */
    public function handle()
    {
        $this->info('Thank you for choosing our packages');

        $this->info('Publishing assets...');
        $this->call('vendor:publish', ['--tag' => 'lakm/contact']);
        $this->info('Completed');

        $this->info('Migrating tables...');
        $this->call('migrate');
        $this->info('Completed');

        $this->info('Thank you for using our applications');

    }
}
