<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Device;
use App\Models\Package;

class CashierDashboard extends Component
{
    public function render()
    {
        return view('livewire.cashier-dashboard', [
            'devices' => Device::with(['rentals' => function ($query) {
                $query->where('status', 'active');
            }])->get(),
            'packages' => Package::all(),
        ]);
    }
}
