<?php

namespace myFavouriteAppliance\Console\Commands;

use Illuminate\Console\Command;
use myFavouriteAppliance\Source\SourceInterface;
use myFavouriteAppliance\SourceUrl;

class RunWebScraping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:web-scraping 
    {url : site appliance url  }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run job to get appliance data from web scratping';

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
     * Run load data from a source
     * @param SourceInterface
     * @return mixed
     */
    public function handle (SourceInterface $source)    {
        $url = $this->argument('url');
        $sourceUrl = SourceUrl::firstOrCreate(['url' => $url]);
        $this->info("Iniciando proceso web scraping cargando: ". $url);
        $source->load($sourceUrl);
        $this->info("Finalizado proceso web scraping: ". $url);
    }
}
