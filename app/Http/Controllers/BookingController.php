<?php

namespace App\Http\Controllers;

use App\Http\Resources\DestinationResource;
use App\Models\Booking;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $booking = Booking::join("users", "users.id", "=", "bookings.user_id")
        ->join("destinations", "destinations.id", "=", "bookings.destination_id")
        ->select("users.name as name", "destinations.name as destination", "bookings.booking_date", "bookings.status")
        ->get();

        return new DestinationResource(true, 'List Data Booking', $booking);

    }

 
        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'booking_date' => 'required',
                'user_id' => 'required',
                'destination_id' => 'required',
                'status' => 'required'
            ]);

            //jika validasinya gagal
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // return response()->json(["Inputan User:" => $request->all()]);

            $booking = Booking::create($request->all());

            return new DestinationResource(true, 'Data Booking Berhasil Ditambahkan!', $booking);
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $validator = Validator::make($request->all(), [
                'booking_date' => 'required',
                'user_id' => 'required|numeric',
                'destination_id' => 'required|numeric',
                'status' => 'required'
            ]);

            //jika validasinya gagal
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // return response()->json(["Inputan User:" => $request->all()]);

            $booking = Booking::find($id);
            $booking->update($request->all());

            return new DestinationResource(true, 'Data Booking Berhasil Diubah!', $booking);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking = Booking::find($id);

        $booking->delete();

        return new DestinationResource(true, 'Data Booking Berhasil Dihapus!', null);
    }
}
