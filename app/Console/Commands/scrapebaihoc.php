<?php

namespace App\Console\Commands;

use App\Models\data;
use App\Models\baihoc;

use Illuminate\Console\Command;

use Weidner\Goutte\GoutteFacade;
class scrapebaihoc extends Command

{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:baihoc';

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
        $crawler = GoutteFacade::request('GET','https://unica.vn/guitar-dem-hat-30-ngay-cung-hien-rau');
        for ($i = 13; $i < 22; $i++){
        $name = $crawler->filter('div.title a')->each(function ($node) {
                return $node -> text('a');
            })[$i];
            $data = [
                'name' => $name,
                'status' => 1,
                'sort' => ($i+1),
                'courses_id' => 1001,
                'chapter_id' => 2,

            ];
            baihoc::create($data);
        }

    }




}
