<?php

use Illuminate\Database\Seeder;
use Faker\Provider\en_US\Address;
class ResponderPatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create();
    	for($i=0; $i<=100; $i++){
         DB::table('responder_patient')->insert([
            'respondent_id' => rand(1,10),
            'patient_id' => rand(1,10),
            'status' => 1,
            'lat' => $faker->latitude(-90, 90),
            'lng' => $faker->latitude(-180, 180)
        ]);
     }
    }
}
