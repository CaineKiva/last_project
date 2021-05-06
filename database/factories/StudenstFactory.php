<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Students;
// use Faker\Generator as Faker;

$factory->define(App\Models\Students::class, function () {
	$faker = Faker\Factory::create('vi_VN');
    return [
       'first_name' => $faker->firstName,
       'last_name' => $faker->lastName,
       'date' => $faker-> dateTimeBetween('-30 years','-18 years'),
       'address' => $faker->address,
       'phone' => $faker->phoneNumber,
       'email' => $faker->unique()->safeEmail(),
       'gender' => $faker->boolean,
       'password' => '1',
       'level' => '3',
      
       
    ];
});
