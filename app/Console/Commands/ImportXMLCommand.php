<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Domain\Car\CarManager;
use App\Services\OfferParser;
use Illuminate\Console\Command;

class ImportXMLCommand extends Command
{
    private const DEFAULT_FILE_PATH = '/var/local/data.xml';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:xml {--p|path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import offer xml file';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(CarManager $manager)
    {
        $filePath = $this->option('path')
            ? realpath($this->option('path'))
            : realpath(self::DEFAULT_FILE_PATH);

        if (!$filePath) {
            $this->error('file not exist');
            return;
        }

        $parser = (new OfferParser($filePath));
        $count = $parser->getCount();

        $offerList = $parser->getOfferList()['offer'];
        $bar = $this->output->createProgressBar($count);

        $bar->start();
        $manager->importOffer($offerList, $count);
        $bar->finish();
        $this->info(PHP_EOL . $count . ' items imported successfully');
    }
}
