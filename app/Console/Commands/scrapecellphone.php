<?php

namespace App\Console\Commands;

use App\Models\cell;
use App\Models\courses;

use Illuminate\Console\Command;

use Weidner\Goutte\GoutteFacade;
class scrapecellphone extends Command

{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:cellphone';

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



        for ($i = 0; $i < 20; $i++){
        $crawler = GoutteFacade::request('GET','https://cellphones.com.vn/mobile/samsung.html');

        $name = $crawler->filter('h3#product_link')->each(function ($node) {
            return $node -> text('');
        })[$i];
        $gia_sale = $crawler->filter('p.special-price span')->each(function ($node) {
            return $node -> text('');
        })[$i];
        $gia_sale = preg_replace('/\D/', '', $gia_sale);

        $gia_croot = $crawler->filter('p.old-price span')->each(function ($node) {
            return $node -> text('');
        })[$i];
        $gia_croot = preg_replace('/\D/', '', $gia_croot);

        $data = [
            'name' => $name,
            'gia_sale' => $gia_sale,
            'gia_croot' => $gia_croot,

        ];

      cell::create($data);
    }










    }

}
