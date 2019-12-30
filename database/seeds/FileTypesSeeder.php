<?php

use App\FileType;
use Illuminate\Database\Seeder;

class FileTypesSeeder extends Seeder
{

    private $file_types = [
        ['id' => 1, 'name' => 'Картинка'],
        ['id' => 2, 'name' => 'Квитанция'],
        ['id' => 3, 'name' => 'Документ'],
        ['id' => 4, 'name' => 'Протокол собрания'],
        ['id' => 5, 'name' => 'Образец заявления'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->file_types as $file_type) {
            FileType::updateOrCreate($file_type);
        }
    }
}
