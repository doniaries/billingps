<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Flux;

class SettingsMenu extends Component
{
    use WithFileUploads;

    public $rental_name;
    public $tv_count;
    public $address;
    public $contact_number;
    public $owner_name;
    public $social_media;
    public $logo;
    public $new_logo;

    public function mount()
    {
        $setting = Setting::first();
        if ($setting) {
            $this->rental_name = $setting->rental_name;
            $this->tv_count = $setting->tv_count;
            $this->address = $setting->address;
            $this->contact_number = $setting->contact_number;
            $this->owner_name = $setting->owner_name;
            $this->social_media = $setting->social_media;
            $this->logo = $setting->logo;
        }
    }

    public function save()
    {
        $this->validate([
            'rental_name' => 'required|string|max:255',
            'tv_count' => 'required|integer|min:1',
            'address' => 'nullable|string',
            'contact_number' => 'nullable|string',
            'owner_name' => 'nullable|string',
            'social_media' => 'nullable|string',
            'new_logo' => 'nullable|image|max:2048',
        ]);

        $setting = Setting::firstOrCreate(['id' => 1]);
        $setting->rental_name = $this->rental_name;
        $setting->tv_count = $this->tv_count;
        $setting->address = $this->address;
        $setting->contact_number = $this->contact_number;
        $setting->owner_name = $this->owner_name;
        $setting->social_media = $this->social_media;

        if ($this->new_logo) {
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }
            $path = $this->new_logo->store('logos', 'public');
            $setting->logo = $path;
            $this->logo = $path;
            $this->new_logo = null; // Reset setelah upload
        }

        $setting->save();

        // Tampilkan notifikasi sukses ala Flux UI
        Flux::toast('Pengaturan berhasil disimpan!');
    }

    public function render()
    {
        return view('livewire.settings-menu');
    }
}
