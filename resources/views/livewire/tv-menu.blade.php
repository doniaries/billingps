<div class="space-y-6">
    <div class="flex justify-between items-center bg-white dark:bg-zinc-900 p-6 rounded-xl border border-zinc-200 dark:border-zinc-700 shadow-sm">
        <div>
            <h3 class="text-lg font-bold">Daftar TV & Console</h3>
            <p class="text-sm text-zinc-500">Kelola jumlah TV, nomor urut, dan tipe PlayStation Anda di sini.</p>
        </div>
        
        <!-- Tombol Tambah (bisa trigger event Alpine.js untuk buka Modal) -->
        <div x-data>
            <flux:button variant="primary" icon="plus" wire:click="create" @click="$dispatch('open-device-modal')">
                Tambah TV
            </flux:button>
        </div>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-700 shadow-sm overflow-hidden">
        <table class="w-full text-left text-sm text-zinc-600 dark:text-zinc-400">
            <thead class="bg-zinc-50 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 font-semibold border-b border-zinc-200 dark:border-zinc-700">
                <tr>
                    <th class="px-6 py-4">No. TV</th>
                    <th class="px-6 py-4">Tipe PS</th>
                    <th class="px-6 py-4">Nama Unit</th>
                    <th class="px-6 py-4">IP Address</th>
                    <th class="px-6 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                @forelse($devices as $device)
                <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800 transition">
                    <td class="px-6 py-4 font-bold text-zinc-900 dark:text-white">TV {{ $device->tv_number }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-indigo-100 text-indigo-700 rounded-md text-xs font-bold">
                            {{ $device->ps_type }}
                        </span>
                    </td>
                    <td class="px-6 py-4">{{ $device->name }}</td>
                    <td class="px-6 py-4 font-mono text-xs">{{ $device->ip_address ?? '-' }}</td>
                    <td class="px-6 py-4 flex items-center gap-2" x-data>
                        <flux:button size="sm" variant="subtle" icon="pencil" wire:click="edit({{ $device->id }})" @click="$dispatch('open-device-modal')">
                            Edit
                        </flux:button>
                        
                        <flux:button size="sm" variant="danger" icon="trash" wire:click="delete({{ $device->id }})" wire:confirm="Yakin ingin menghapus TV ini?">
                            Hapus
                        </flux:button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-zinc-500">
                        Belum ada TV yang ditambahkan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Form Tambah/Edit TV (Menggunakan x-data standar alpinejs) -->
    <div x-data="{ open: false }" 
         @open-device-modal.window="open = true" 
         @close-device-modal.window="open = false" 
         x-show="open" 
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
         style="display: none;">
         
        <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-2xl border border-zinc-200 dark:border-zinc-700 w-full max-w-lg overflow-hidden" @click.outside="open = false">
            <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 flex justify-between items-center bg-zinc-50 dark:bg-zinc-800">
                <h3 class="font-bold text-lg text-zinc-800 dark:text-white">
                    {{ $isEditMode ? 'Edit Data TV' : 'Tambah TV Baru' }}
                </h3>
                <button @click="open = false" class="text-zinc-400 hover:text-zinc-600">
                    <flux:icon.x-mark class="size-5" />
                </button>
            </div>
            
            <form wire:submit="save" class="p-6 space-y-5">
                <div class="grid grid-cols-2 gap-4">
                    <flux:input type="number" wire:model.live="tv_number" label="Nomor TV" required />
                    
                    <flux:select wire:model.live="ps_type" label="Tipe Console" required>
                        <option value="PS 3">PlayStation 3</option>
                        <option value="PS 4">PlayStation 4</option>
                        <option value="PS 5">PlayStation 5</option>
                    </flux:select>
                </div>
                
                <flux:input wire:model="name" label="Nama Unit (Dibuat Otomatis)" readonly class="bg-zinc-100 dark:bg-zinc-800 text-zinc-500 cursor-not-allowed" />
                <flux:input wire:model="ip_address" label="IP Address TV/Smart Socket" placeholder="192.168.1.xxx" />
                
                <div class="flex justify-end gap-3 pt-4 border-t border-zinc-200 dark:border-zinc-700">
                    <flux:button type="button" @click="open = false">Batal</flux:button>
                    <flux:button type="submit" variant="primary">Simpan</flux:button>
                </div>
            </form>
        </div>
    </div>
</div>
