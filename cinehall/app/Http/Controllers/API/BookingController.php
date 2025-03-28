<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $bookingRepository;

    public function __construct(BookingRepositoryInterface $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }
    
    public function index(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->bookingRepository->getUserBookings($request->user()->id)
        ]);
    }
    public function store(BookingRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $data['expires_at'] = Carbon::now()->addMinutes(15);
        
        $booking = $this->bookingRepository->create($data);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Booking created successfully',
            'data' => $booking
        ], 201);
    }

    public function show($id)
    {
        $booking = $this->bookingRepository->find($id);
        
        $this->authorize('view', $booking);
        
        return response()->json([
            'status' => 'success',
            'data' => $booking
        ]);
    }
    public function destroy($id)
    {
        $booking = $this->bookingRepository->find($id);
        
        $this->authorize('delete', $booking);
        
        $this->bookingRepository->cancel($id);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Booking cancelled successfully'
        ]);
    }
}