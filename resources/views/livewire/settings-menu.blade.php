<div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-xl p-6 shadow-sm">
    <form wire:submit="save" class="space-y-6 max-w-2xl">
        
        <div class="flex items-center gap-6 pb-6 border-b border-zinc-200 dark:border-zinc-700">
            <!-- Menampilkan Logo -->
            <div class="h-24 w-24 rounded-xl border border-zinc-200 dark:border-zinc-700 overflow-hidden flex items-center justify-center bg-zinc-50 dark:bg-zinc-800">
                @if ($new_logo)
                    <img src="{{ $new_logo->temporaryUrl() }}" class="h-full w-full object-cover">
                @elseif ($logo)
                    <img src="{{ asset('storage/' . $logo) }}" class="h-full w-full object-cover">
                @else
                    <flux:icon.photo class="text-zinc-400 size-8" />
                @endif
            </div>
            
            <div class="flex-1">
                <flux:input type="file" wire:model="new_logo" label="Logo Rental" description="Upload gambar berformat JPG, PNG maksimal 2MB." />
                <div wire:loading wire:target="new_logo" class="text-sm text-blue-500 mt-2 flex items-center gap-2">
                    <flux:icon.arrow-path class="animate-spin size-4" /> Mengunggah logo...
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <flux:input wire:model="rental_name" label="Nama Rental" placeholder="Contoh: Gober Zone" required />
            <flux:input type="number" wire:model="tv_count" label="Jumlah TV" required min="1" />
        </div>

        <flux:input wire:model="owner_name" label="Nama Pemilik" placeholder="Nama Anda" />
        <flux:input wire:model="contact_number" label="Nomor WhatsApp" placeholder="0812xxxxxx" />
        <flux:input wire:model="social_media" label="Akun Sosial Media" placeholder="@username_ig" />
        
        <flux:textarea wire:model="address" label="Alamat Lengkap" rows="3" placeholder="Jl. Pasar Inpres No.1..." />

        <div class="pt-4 flex justify-end">
            <flux:button type="submit" variant="primary" icon="check" class="w-full md:w-auto">
                <span wire:loading.remove wire:target="save">Simpan Pengaturan</span>
                <span wire:loading wire:target="save">Menyimpan...</span>
            </flux:button>
        </div>
    </form>
</div>
