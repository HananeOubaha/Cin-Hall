<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieRequest;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    protected $movieRepository;

    public function __construct(MovieRepositoryInterface $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

   
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->movieRepository->all()
        ]);
    }

    
    public function show($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->movieRepository->find($id)
        ]);
    }

    public function popular()
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->movieRepository->getPopularMovies()
        ]);
    }

  
    public function upcoming()
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->movieRepository->getUpcomingMovies()
        ]);
    }
}