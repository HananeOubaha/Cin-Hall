<?php

namespace App\Repositories\Eloquent;

use App\Models\Movie;
use App\Repositories\Interfaces\MovieRepositoryInterface;

class MovieRepository implements MovieRepositoryInterface
{
    protected $model;

    public function __construct(Movie $movie)
    {
        $this->model = $movie;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $movie = $this->find($id);
        $movie->update($data);
        return $movie;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function getPopularMovies()
    {
        return $this->model->withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->take(10)
            ->get();
    }

    public function getUpcomingMovies()
    {
        return $this->model->where('release_date', '>', now())
            ->orderBy('release_date', 'asc')
            ->get();
    }
}