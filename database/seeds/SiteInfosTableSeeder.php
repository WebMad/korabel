<?php

use App\SiteInfo;
use Illuminate\Database\Seeder;

class   SiteInfosTableSeeder extends Seeder
{
    private $data;
    private $fields;

    public function __construct()
    {
        $this->data = [
            ['name' => 'site_name', 'content' => env('APP_NAME')],
            ['name' => 'site_subname', 'content' => 'Садоводческое некоммерческое товарищество'],
            ['name' => 'contact_phone', 'content' => '+7 (999) 999-99-99'],
            ['name' => 'contact_email', 'content' => env('MAIL_FROM_NAME', 'example@domain.ru')],
            ['name' => 'contact_address', 'content' => 'г. Стандартный, ул. Стандартная, дом 1А'],
            ['name' => 'legal_address', 'content' => 'г. Стандартный, ул. Стандартная, дом 1А'],
            ['name' => 'latitude', 'content' => '55.75222'],
            ['name' => 'longitude', 'content' => '37.61556'],
        ];
        $this->fields = [
            ['name' => 'site_name'],
            ['name' => 'site_subname'],
            ['name' => 'contact_phone'],
            ['name' => 'contact_email'],
            ['name' => 'contact_address'],
            ['name' => 'legal_address'],
            ['name' => 'latitude'],
            ['name' => 'longitude'],
        ];
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $key => $site_info) {
            SiteInfo::updateOrCreate($this->fields[$key], $site_info);
        }
    }
}
