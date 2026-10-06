<div>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
        @foreach($devices as $device)
            @php
                $activeRental = $device->rentals->first();
            @endphp
            <div class="bg-white rounded-xl shadow-sm border {{ $activeRental ? 'border-red-400' : 'border-green-400' }} p-6 flex flex-col items-center justify-center">
                <h3 class="text-lg font-bold text-gray-800">{{ $device->name }}</h3>
                <div class="text-sm text-gray-500 mb-4">{{ $device->ip_address ?? 'No IP Set' }}</div>
                
                @if($activeRental)
                    <div class="text-red-600 font-bold text-xl mb-2">In Use</div>
                    <div class="text-sm text-gray-600">Selesai: {{ $activeRental->end_time ? $activeRental->end_time->format('H:i') : 'Open Billing' }}</div>
                    <button class="mt-4 px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">Stop / Checkout</button>
                @else
                    <div class="text-green-600 font-bold text-xl mb-2">Available</div>
                    <button class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Mulai Sewa</button>
                @endif
            </div>
        @endforeach
    </div>
</div>
