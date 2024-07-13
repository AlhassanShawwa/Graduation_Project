<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $doctors =  Doctor::factory()->count(30)->create();

        // foreach ($doctors as $doctor){
        //     $doctor->doctorappointments()->attach($Appointments);
        // }


       $Appointments = Appointment::all();
       Doctor::all()->each(function ($doctor) use ($Appointments) {
               $doctor->doctorappointments()->attach(
               $Appointments->random(rand(1,7))->pluck('id')->toArray()
           );
       });


    }
}
