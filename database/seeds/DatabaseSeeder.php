<?php

use App\Models\NewsCategory;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        /*
         * News category
         */
        $newsCategories = [
            [
                'id' => 1, 'name' => 'Поступление'
            ],
            [
                'id' => 2, 'name' => 'Навчання'
            ],
            [
                'id' => 3, 'name' => 'Життя кафедри'
            ],
        ];

        foreach ($newsCategories as $category) {
            $tableName = (new NewsCategory)->getTable();
            if (DB::table($tableName)->where('id', $category['id'])->exists()) {
                DB::table($tableName)->where('id', $category['id'])->update($category);
            } else {
                DB::table($tableName)->insert($category);
            }
        }
    }
}
