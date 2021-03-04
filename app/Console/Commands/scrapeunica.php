<?php

namespace App\Console\Commands;

use App\Models\courses;

use Illuminate\Console\Command;

use Weidner\Goutte\GoutteFacade;
class scrapeunica extends Command

{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:unica';

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
        $crawler = GoutteFacade::request('GET','https://unica.vn/tag/guitar?sort_by=learn-most');
        for ($i = 0; $i < 15; $i++){
        $thumb = $crawler->filter('img.img-responsive')->each(function ($node) {
            return $node -> attr('src');
        })[$i + 1];


        $name = $crawler->filter('h3.title-course')->each(function ($node) {
                return $node -> text('');
            })[$i];
        $tacgia = $crawler->filter('div.name-gv b')->each(function ($node) {
            return $node -> text('b');
        })[$i];
        $gia_sale  = $crawler->filter('span.price-a')->each(function ($node) {
            return $node -> text('');
        })[$i];
        $gia_sale = preg_replace('/\D/', '', $gia_sale);
        $gia_croot = $crawler->filter('span.price-b')->each(function ($node) {
            return $node -> text('');
        })[$i];
        $gia_croot = preg_replace('/\D/', '', $gia_croot);

        $data = [
            'name' => $name,

            'images' => $thumb,
            'price_sale' => $gia_sale,
            'price_root' => $gia_croot,

        ];

         courses::create($data);



        }


    }

}
