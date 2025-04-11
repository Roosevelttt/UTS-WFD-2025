@extends('layout')

@section('title', 'Form Pemesanan Lapangan')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Form Pemesanan Lapangan</h1>
    
    <form action="{{ route('orders.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_pemesan">
                Nama Pemesan
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_pemesan') border-red-500 @enderror" 
                id="nama_pemesan" 
                type="text" 
                name="nama_pemesan" 
                value="{{ old('nama_pemesan') }}"
                placeholder="Masukkan nama pemesan">
            @error('nama_pemesan')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="wa_pemesan">
                Nomor WhatsApp
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('wa_pemesan') border-red-500 @enderror" 
                id="wa_pemesan" 
                type="text" 
                name="wa_pemesan" 
                value="{{ old('wa_pemesan') }}"
                placeholder="Masukkan nomor WhatsApp">
            @error('wa_pemesan')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggal">
                Tanggal Booking
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tanggal') border-red-500 @enderror" 
                id="tanggal" 
                type="date" 
                name="tanggal" 
                value="{{ old('tanggal') }}"
                min="{{ date('Y-m-d') }}">
            @error('tanggal')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="schedule_id">
                Jadwal Lapangan
            </label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('schedule_id') border-red-500 @enderror" 
                id="schedule_id" 
                name="schedule_id">
                <option value="">Pilih Jadwal</option>
                @foreach ($schedules as $schedule)
                    <option value="{{ $schedule->id }}" {{ old('schedule_id') == $schedule->id ? 'selected' : '' }}>
                        Lapangan {{ $schedule->nomor_lapangan }} - {{ $schedule->jam_mulai }} s/d {{ $schedule->jam_selesai }}
                    </option>
                @endforeach
            </select>
            @error('schedule_id')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex items-center justify-between">
            <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                type="submit">
                Simpan
            </button>
            <a href="{{ route('orders.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection