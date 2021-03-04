<?php

namespace App\Console\Commands;

use App\Models\data;
use App\Models\giangvien;

use Illuminate\Console\Command;

use Weidner\Goutte\GoutteFacade;
class scrapegiangvien extends Command

{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:giangvien';

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
        $crawler = GoutteFacade::request('GET', 'https://unica.vn/tag/guitar');
        $linkpost = $crawler->filter('div.col-md-4.form-group a' )->each(function ($node) {
            return $node -> attr("href");
          });

          foreach ($linkpost as $link){
            self::scrapedata($link);
          }

    }
    public static function scrapedata($url)
    {
        $crawler = GoutteFacade::request('GET',$url);
        $name = $crawler->filter('div.u-detail-tea span')->each(function ($node) {
                return $node -> text('span');
            })[0];
        $description = $crawler->filter('div.uct-more-gv')->each(function ($node) {
                return $node -> text('');
            })[0];
         $thumb = $crawler->filter('div.uct-ava-gv img')->each(function ($node) {
                return $node -> attr('src');
            })[0];
            $data = [
                'hoten' => $name,
                'description' => $description,
                'images' => $thumb,

            ];
            giangvien::create($data);


    }




}
