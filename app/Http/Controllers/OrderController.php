<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('schedule')->orderBy('tanggal', 'asc');
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nama_pemesan', 'like', "%{$search}%");
        }
        
        if ($request->has('tanggal')) {
            $tanggal = $request->tanggal;
            if (!empty($tanggal)) {
                $query->whereDate('tanggal', $tanggal);
            }
        }
        
        $orders = $query->get();
        
        return view('orders.index', compact('orders'));
    }
    
    public function create()
    {
        $schedules = Schedule::all();
        return view('orders.create', compact('schedules'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:100',
            'wa_pemesan' => 'required|string|max:100',
            'tanggal' => 'required|date|after_or_equal:today',
            'schedule_id' => 'required|exists:schedules,id',
        ]);
        
        $schedule = Schedule::findOrFail($request->schedule_id);
        $bookingDate = Carbon::parse($request->tanggal)->format('Y-m-d');
        
        $conflictingBooking = Order::where('schedule_id', $request->schedule_id)
            ->whereDate('tanggal', $bookingDate)
            ->first();
            
        if ($conflictingBooking) {
            return redirect()->back()
                ->withInput()
                ->with('error', "Jadwal untuk lapangan {$schedule->nomor_lapangan} pada tanggal " . 
                    Carbon::parse($bookingDate)->format('d-m-Y') . 
                    " jam {$schedule->jam_mulai}-{$schedule->jam_selesai} sudah dipesan!");
        }
        
        $order = new Order();
        $order->nama_pemesan = $request->nama_pemesan;
        $order->wa_pemesan = $request->wa_pemesan;
        $order->tanggal = $request->tanggal;
        $order->schedule_id = $request->schedule_id;
        $order->save();
        
        return redirect()->route('orders.index')
            ->with('success', 'Pemesanan berhasil dibuat!');
    }
    
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $schedules = Schedule::all();
        return view('orders.edit', compact('order', 'schedules'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:100',
            'wa_pemesan' => 'required|string|max:100',
            'tanggal' => 'required|date|after_or_equal:today',
            'schedule_id' => 'required|exists:schedules,id',
        ]);
        
        $order = Order::findOrFail($id);
        
        if ($request->schedule_id != $order->schedule_id || $request->tanggal != $order->tanggal) {
            $schedule = Schedule::findOrFail($request->schedule_id);
            $bookingDate = Carbon::parse($request->tanggal)->format('Y-m-d');
            
            $conflictingBooking = Order::where('schedule_id', $request->schedule_id)
                ->whereDate('tanggal', $bookingDate)
                ->where('id', '!=', $id) 
                ->first();
                
            if ($conflictingBooking) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Jadwal untuk lapangan {$schedule->nomor_lapangan} pada tanggal " . 
                        Carbon::parse($bookingDate)->format('d-m-Y') . 
                        " jam {$schedule->jam_mulai}-{$schedule->jam_selesai} sudah dipesan!");
            }
        }
        
        $order->nama_pemesan = $request->nama_pemesan;
        $order->wa_pemesan = $request->wa_pemesan;
        $order->tanggal = $request->tanggal;
        $order->schedule_id = $request->schedule_id;
        $order->save();
        
        return redirect()->route('orders.index')
            ->with('success', 'Pemesanan berhasil diperbarui!');
    }
    
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        
        return redirect()->route('orders.index')
            ->with('success', 'Pemesanan berhasil dibatalkan!');
    }
}