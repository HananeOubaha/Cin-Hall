<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowtimeRequest;
use App\Repositories\Interfaces\ShowtimeRepositoryInterface;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
{
    protected $showtimeRepository;

    public function __construct(ShowtimeRepositoryInterface $showtimeRepository)
    {
        $this->showtimeRepository = $showtimeRepository;
    }

    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->showtimeRepository->all()
        ]);
    }

    public function store(ShowtimeRequest $request)
    {
        $showtime = $this->showtimeRepository->create($request->validated());
        
        return response()->json([
            'status' => 'success',
            'message' => 'Showtime created successfully',
            'data' => $showtime
        ], 201);
    }

    public function show($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->showtimeRepository->find($id)
        ]);
    }

    public function availableSeats($id)
    {
        $showtime = $this->showtimeRepository->find($id);
        
        return response()->json([
            'status' => 'success',
            'data' => $showtime->availableSeats()
        ]);
    }
}