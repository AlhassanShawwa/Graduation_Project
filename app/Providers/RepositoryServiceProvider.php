<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Doctors\DoctorRepository;
use App\Repository\Patients\PatientRepository;
use App\Repository\Sections\SectionRepository;
use App\Repository\Ambulances\AmbulanceRepository;
use App\Repository\insurances\insuranceRepository;
use App\Repository\Services\SingleServiceRepository;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Interfaces\Patients\PatientRepositoryInterface;
use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;
use App\Interfaces\insurances\insuranceRepositoryInterface;
use App\Interfaces\Services\SingleServiceRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(SectionRepositoryInterface::class,SectionRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class,DoctorRepository::class);
        $this->app->bind(SingleServiceRepositoryInterface::class,SingleServiceRepository::class);
        $this->app->bind(insuranceRepositoryInterface::class,insuranceRepository::class);
        $this->app->bind(AmbulanceRepositoryInterface::class,AmbulanceRepository::class);
        $this->app->bind(PatientRepositoryInterface::class,PatientRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
