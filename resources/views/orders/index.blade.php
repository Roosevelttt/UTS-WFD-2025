@extends('layout')

@section('title', 'Daftar Pemesanan Lapangan')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">List Pemesanan Lapangan</h1>
        <a href="{{ route('orders.create') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            + Pemesanan Baru
        </a>
    </div>
    
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <form action="{{ route('orders.index') }}" method="GET" class="mb-6">
            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="search">
                        Nama Pemesan
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                        id="search" 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Cari berdasarkan nama">
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="tanggal">
                        Tanggal
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                        id="tanggal" 
                        type="date" 
                        name="tanggal" 
                        value="{{ request('tanggal') }}">
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0 flex items-end">
                    <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-4 rounded" type="submit">
                        Tampilkan
                    </button>
                    <a href="{{ route('orders.index') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-3 px-4 rounded ml-2">
                        Reset
                    </a>
                </div>
            </div>
        </form>
        
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-500">
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white tracking-wider">
                            No
                        </th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white tracking-wider">
                            Nama Pemesan
                        </th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white tracking-wider">
                            Nomor WhatsApp
                        </th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white tracking-wider">
                            Tanggal Booking
                        </th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white tracking-wider">
                            Nomor Lapangan
                        </th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white tracking-wider">
                            Jam Pemakaian
                        </th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-white tracking-wider">
                            Tindakan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $index => $order)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            {{ $order->nama_pemesan }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            {{ $order->wa_pemesan }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            {{ \Carbon\Carbon::parse($order->tanggal)->format('d F Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            {{ $order->schedule->nomor_lapangan }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            {{ $order->schedule->jam_mulai }} - {{ $order->schedule->jam_selesai }}
                        </td>
                        <td class="px-3 py-4 whitespace-nowrap border-b border-gray-200">
                            <div class="flex space-x-2">
                                <a href="{{ route('orders.edit', $order->id) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-3 rounded">Edit</a>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pemesanan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 rounded">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 text-center" colspan="6">
                            Tidak ada data pemesanan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection