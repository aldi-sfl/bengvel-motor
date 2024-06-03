<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            [
                'id' => 1,
                'name'=>'Admin',
                'email'=>'admin@admin.com',
                'password'=> Hash::make('12345'),
                'is_admin' => true
                ]
        ]);

        DB::table('categories')->insert([
            [
                'id' => 1,
                'category_name' => 'accesories',
            ],
            [
                'id' => 2,
                'category_name' => 'spare part',
            ],
            [
                'id' => 3,
                'category_name' => 'kelistrikan',
            ],
            [
                'id' => 4,
                'category_name' => 'ban',
            ],
            [
                'id' => 5,
                'category_name' => 'suku cadang',
            ],

        ]);

        DB::table('products')->insert([
            [
                'id' => 1,
                'name' => 'spion',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum doloribus quasi eaque est molestiae. Provident corporis ipsum at sequi architecto facilis eum consectetur, iusto ipsa dignissimos voluptatum consequuntur facere neque sapiente nobis dolor doloremque quos consequatur earum necessitatibus libero nulla praesentium voluptates nostrum. Molestiae porro atque iusto, unde, veniam quam delectus blanditiis possimus repudiandae ducimus distinctio soluta. Eos, enim?',
                'category_id' => 1,
                'price' => 30000,
                'weight' => 500,
                'stock' => 32,
                'status' => '1'
            ],
            [
                'id' => 2,
                'name' => 'lampu',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum doloribus quasi eaque est molestiae. Provident corporis ipsum at sequi architecto facilis eum consectetur, iusto ipsa dignissimos voluptatum consequuntur facere neque sapiente nobis dolor doloremque quos consequatur earum necessitatibus libero nulla praesentium voluptates nostrum. Molestiae porro atque iusto, unde, veniam quam delectus blanditiis possimus repudiandae ducimus distinctio soluta. Eos, enim?',
                'category_id' => 3,
                'price' => 50000,
                'weight' => 300,
                'stock' => 52,
                'status' => '1'
            ],
            [
                'id' => 3,
                'name' => 'oli',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum doloribus quasi eaque est molestiae. Provident corporis ipsum at sequi architecto facilis eum consectetur, iusto ipsa dignissimos voluptatum consequuntur facere neque sapiente nobis dolor doloremque quos consequatur earum necessitatibus libero nulla praesentium voluptates nostrum. Molestiae porro atque iusto, unde, veniam quam delectus blanditiis possimus repudiandae ducimus distinctio soluta. Eos, enim?',
                'category_id' => 5,
                'price' => 65000,
                'weight' => 1000,
                'stock' => 20,
                'status' => '1'
            ],
            // [
            //     'id' => 4,
            //     'name' => 'stang',
            //     'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum doloribus quasi eaque est molestiae. Provident corporis ipsum at sequi architecto facilis eum consectetur, iusto ipsa dignissimos voluptatum consequuntur facere neque sapiente nobis dolor doloremque quos consequatur earum necessitatibus libero nulla praesentium voluptates nostrum. Molestiae porro atque iusto, unde, veniam quam delectus blanditiis possimus repudiandae ducimus distinctio soluta. Eos, enim?',
            //     'category_id' => 2,
            //     'price' => 105000,
            //     'stock' => 12,
            //     'status' => '1'
            // ],
            // [
            //     'id' => 5,
            //     'name' => 'standar variasi',
            //     'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum doloribus quasi eaque est molestiae. Provident corporis ipsum at sequi architecto facilis eum consectetur, iusto ipsa dignissimos voluptatum consequuntur facere neque sapiente nobis dolor doloremque quos consequatur earum necessitatibus libero nulla praesentium voluptates nostrum. Molestiae porro atque iusto, unde, veniam quam delectus blanditiis possimus repudiandae ducimus distinctio soluta. Eos, enim?',
            //     'category_id' => 1,
            //     'price' => 35000,
            //     'stock' => 15,
            //     'status' => '1'
            // ],
            // [
            //     'id' => 6,
            //     'name' => 'ban',
            //     'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum doloribus quasi eaque est molestiae. Provident corporis ipsum at sequi architecto facilis eum consectetur, iusto ipsa dignissimos voluptatum consequuntur facere neque sapiente nobis dolor doloremque quos consequatur earum necessitatibus libero nulla praesentium voluptates nostrum. Molestiae porro atque iusto, unde, veniam quam delectus blanditiis possimus repudiandae ducimus distinctio soluta. Eos, enim?',
            //     'category_id' => 4,
            //     'price' => 95000,
            //     'stock' => 30,
            //     'status' => '1'
            // ],
            // [
            //     'id' => 7,
            //     'name' => 'master rem',
            //     'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum doloribus quasi eaque est molestiae. Provident corporis ipsum at sequi architecto facilis eum consectetur, iusto ipsa dignissimos voluptatum consequuntur facere neque sapiente nobis dolor doloremque quos consequatur earum necessitatibus libero nulla praesentium voluptates nostrum. Molestiae porro atque iusto, unde, veniam quam delectus blanditiis possimus repudiandae ducimus distinctio soluta. Eos, enim?',
            //     'category_id' => 2,
            //     'price' => 75000,
            //     'stock' => 23,
            //     'status' => '1'
            // ],
            // [
            //     'id' => 8,
            //     'name' => 'velk',
            //     'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum doloribus quasi eaque est molestiae. Provident corporis ipsum at sequi architecto facilis eum consectetur, iusto ipsa dignissimos voluptatum consequuntur facere neque sapiente nobis dolor doloremque quos consequatur earum necessitatibus libero nulla praesentium voluptates nostrum. Molestiae porro atque iusto, unde, veniam quam delectus blanditiis possimus repudiandae ducimus distinctio soluta. Eos, enim?',
            //     'category_id' => 2,
            //     'price' => 70000,
            //     'stock' => 19,
            //     'status' => '1'
            // ],
            ]);

    }
}
