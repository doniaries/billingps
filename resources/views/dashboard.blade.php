<x-layouts::app :title="\App\Models\Setting::first()->rental_name ?? __('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <livewire:cashier-dashboard />
    </div>
</x-layouts::app>
