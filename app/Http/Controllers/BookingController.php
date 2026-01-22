<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BookingController extends Controller
{
    // List all bookings (for admin)
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        
        $bookings = Booking::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return Inertia::render('Admin/Bookings', [
            'bookings' => $bookings,
        ]);
    }

    // Show booking form
    public function create()
    {
        return Inertia::render('Booking/Create');
    }

    // Store new booking
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'event_type' => 'required|in:personal,event',
            'event_date' => 'required|date|after:today',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
        ]);

        $booking = Booking::create([
            ...$validated,
            'user_id' => Auth::id() ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.show', $booking)->with('success', 'Pemesanan berhasil dibuat!');
    }

    // Show booking details
    public function show(Booking $booking)
    {
        if ($booking->user_id !== null && Auth::id() !== $booking->user_id) {
            if (Auth::user()->role !== 'admin') {
                abort(403, 'Unauthorized');
            }
        }

        return Inertia::render('Booking/Show', [
            'booking' => $booking->load('user'),
        ]);
    }

    // List user's bookings
    public function myBookings()
    {
        $bookings = Auth::user()->bookings()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return Inertia::render('Booking/MyBookings', [
            'bookings' => $bookings,
        ]);
    }

    // Update booking status (for admin)
    public function updateStatus(Booking $booking, Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $booking->update($validated);

        return back()->with('success', 'Status pemesanan berhasil diubah!');
    }

    // Delete booking
    public function destroy(Booking $booking)
    {
        if ($booking->user_id !== null && Auth::id() !== $booking->user_id) {
            if (Auth::user()->role !== 'admin') {
                abort(403, 'Unauthorized');
            }
        }

        $booking->delete();

        return back()->with('success', 'Pemesanan berhasil dihapus!');
    }
}
