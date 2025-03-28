<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\{
    MovieRepositoryInterface,
    ShowtimeRepositoryInterface,
    BookingRepositoryInterface
};
use App\Repositories\Eloquent\{
    MovieRepository,
    ShowtimeRepository,
    BookingRepository
};

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(MovieRepositoryInterface::class, MovieRepository::class);
        $this->app->bind(ShowtimeRepositoryInterface::class, ShowtimeRepository::class);
        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);
    }
}