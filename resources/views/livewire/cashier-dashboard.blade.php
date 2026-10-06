<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 p-8 max-w-7xl mx-auto">
        @foreach($devices as $device)
            @php
                $activeRental = $device->rentals->first();
            @endphp
            <div class="relative bg-white rounded-2xl shadow-lg border {{ $activeRental ? 'border-rose-200 shadow-rose-100/50' : 'border-emerald-200 shadow-emerald-100/50' }} p-6 flex flex-col items-center justify-center transition-all duration-300 hover:-translate-y-1 hover:shadow-xl group overflow-hidden">
                
                {{-- Decorative background blob --}}
                <div class="absolute -top-12 -right-12 w-32 h-32 rounded-full opacity-10 transition-transform duration-500 group-hover:scale-[1.75] {{ $activeRental ? 'bg-rose-500' : 'bg-emerald-500' }}"></div>

                {{-- Status Badge --}}
                <div class="absolute top-5 left-5">
                    @if($activeRental)
                        <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20">
                            <svg class="w-2 h-2 mr-1.5 fill-rose-500 animate-pulse" viewBox="0 0 6 6" aria-hidden="true"><circle cx="3" cy="3" r="3" /></svg>
                            In Use
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                            <svg class="w-2 h-2 mr-1.5 fill-emerald-500" viewBox="0 0 6 6" aria-hidden="true"><circle cx="3" cy="3" r="3" /></svg>
                            Available
                        </span>
                    @endif
                </div>

                {{-- Icon / Graphic --}}
                <div class="mt-8 mb-5 p-4 rounded-full {{ $activeRental ? 'bg-rose-50 text-rose-500' : 'bg-emerald-50 text-emerald-500' }} ring-1 {{ $activeRental ? 'ring-rose-100' : 'ring-emerald-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>

                {{-- TV Name --}}
                <h3 class="text-xl font-bold text-slate-800 tracking-tight z-10">{{ $device->name }}</h3>
                <div class="text-xs font-medium text-slate-400 mt-1.5 mb-6 flex items-center gap-1.5 z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 opacity-70" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                    {{ $device->ip_address ?? 'No IP Set' }}
                </div>
                
                @if($activeRental)
                    <div class="w-full bg-slate-50/80 rounded-xl p-3.5 mb-5 text-center border border-slate-100 z-10">
                        <div class="text-[10px] text-slate-500 uppercase tracking-widest font-bold mb-1">Selesai Pada</div>
                        <div class="text-slate-800 font-bold text-lg font-mono">{{ $activeRental->end_time ? $activeRental->end_time->format('H:i') : 'Open Billing' }}</div>
                    </div>
                    <button class="w-full relative inline-flex items-center justify-center px-6 py-3 overflow-hidden text-sm font-semibold text-rose-700 bg-rose-50 border border-rose-200 rounded-xl hover:text-white transition-all duration-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 group z-10">
                        <span class="absolute w-0 h-0 transition-all duration-300 ease-out bg-rose-600 rounded-full group-hover:w-full group-hover:h-56"></span>
                        <span class="relative flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1V8a1 1 0 00-1-1H8z" clip-rule="evenodd" />
                            </svg>
                            Checkout
                        </span>
                    </button>
                @else
                    <div class="h-[74px]"></div> {{-- Spacer to keep cards same height --}}
                    <button class="w-full relative inline-flex items-center justify-center px-6 py-3 overflow-hidden text-sm font-semibold text-white bg-emerald-600 rounded-xl hover:bg-emerald-500 transition-all duration-300 shadow-md shadow-emerald-500/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 group z-10">
                        <span class="absolute w-0 h-0 transition-all duration-300 ease-out bg-emerald-500 rounded-full group-hover:w-full group-hover:h-56"></span>
                        <span class="relative flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                            Mulai Sewa
                        </span>
                    </button>
                @endif
            </div>
        @endforeach
    </div>
</div>
