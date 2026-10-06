<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Device;
use Flux;

class TvMenu extends Component
{
    public $devices;
    public $deviceId;
    public $tv_number;
    public $ps_type = 'PS 4'; // Default
    public $ip_address;
    public $name;

    // Untuk mengontrol modal (jika manual), tapi kita gunakan Flux Modal state
    public $isEditMode = false;

    public function mount()
    {
        $this->loadDevices();
    }

    public function loadDevices()
    {
        $this->devices = Device::orderBy('tv_number')->get();
    }

    public function create()
    {
        $this->resetFields();
        $this->isEditMode = false;
    }

    public function edit($id)
    {
        $this->resetFields();
        $this->isEditMode = true;
        $device = Device::findOrFail($id);
        
        $this->deviceId = $device->id;
        $this->tv_number = $device->tv_number;
        $this->ps_type = $device->ps_type;
        $this->ip_address = $device->ip_address;
        $this->name = $device->name;
    }

    public function updatedTvNumber()
    {
        $this->generateName();
    }

    public function updatedPsType()
    {
        $this->generateName();
    }

    private function generateName()
    {
        if ($this->tv_number && $this->ps_type) {
            $this->name = "TV {$this->tv_number} - {$this->ps_type}";
        }
    }

    public function save()
    {
        $this->validate([
            'tv_number' => 'required|integer|min:1',
            'ps_type' => 'required|string',
            'ip_address' => 'nullable|string',
        ]);

        $this->generateName();

        Device::updateOrCreate(
            ['id' => $this->deviceId],
            [
                'tv_number' => $this->tv_number,
                'ps_type' => $this->ps_type,
                'ip_address' => $this->ip_address,
                'name' => $this->name,
            ]
        );

        $this->loadDevices();
        
        // Tutup modal menggunakan event Alpine atau biarkan front-end menutupnya
        $this->dispatch('close-device-modal');
        
        Flux::toast($this->isEditMode ? 'TV berhasil diubah.' : 'TV berhasil ditambahkan.');
    }

    public function delete($id)
    {
        Device::findOrFail($id)->delete();
        $this->loadDevices();
        Flux::toast('Data TV berhasil dihapus.');
    }

    private function resetFields()
    {
        $this->deviceId = null;
        $this->tv_number = '';
        $this->ps_type = 'PS 4';
        $this->ip_address = '';
        $this->name = '';
    }

    public function render()
    {
        return view('livewire.tv-menu');
    }
}
