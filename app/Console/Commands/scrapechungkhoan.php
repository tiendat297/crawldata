<?php

namespace App\Console\Commands;

use App\Models\data;
use App\Models\baihoc;

use Illuminate\Console\Command;

use Weidner\Goutte\GoutteFacade;
class scrapechungkhoan extends Command

{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:chungkhoan';

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
     * @return int
     */


    public function handle()
    {
        $crawler = GoutteFacade::request('GET','https://trade.vndirect.com.vn/chung-khoan/danh-muc');

        $name = $crawler->filter('div.stock-transactions table tbody')->each(function ($node) {
            print($node -> text());
                return $node -> text('tbody');
            });



    }




}
