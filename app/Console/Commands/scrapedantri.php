<?php

namespace App\Console\Commands;

use App\Models\data;

use Illuminate\Console\Command;

use Weidner\Goutte\GoutteFacade;
class scrapedantri extends Command

{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:dantri';

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
        $crawler = GoutteFacade::request('GET', 'https://dantri.com.vn/lao-dong-viec-lam.htm');
        $linkpost = $crawler->filter('h3.news-item__title a')->each(function ($node) {
            return $node -> attr("href");
          });

          foreach ($linkpost as $link){
            self::scrapedata($link);
          }

    }
    public static function scrapedata($url){
        $crawler = GoutteFacade::request('GET', $url);

        $title = $crawler->filter('h1.dt-news__title')->each(function ($node) {
          return $node -> text();
        })[0];

        $description = $crawler->filter('div.dt-news__sapo')->each(function ($node) {
            return $node -> text();
          })[0];
        $description = str_replace('Dân trí','',$description);


        $content = $crawler->filter('div.dt-news__content')->each(function ($node) {

        return $node -> text();
             })[0];

      $thumb = $crawler->filter('figure.image.align-center.img-wrapper img')->each(function ($node) {
        return $node -> attr('src');
      });
          $data = [
              'title' => $title,
              'content' => $content,
              'description' => $description,

          ];

        data::create($data);

    }
}
