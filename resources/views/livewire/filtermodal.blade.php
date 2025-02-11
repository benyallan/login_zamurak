<?php

use Livewire\Volt\Component;
use App\Enums\UserStatus;

new class extends Component {
    public bool $isOpen = false;
    public ?string $statusFilter = null;

    protected $listeners = ['openFilterModal' => 'open'];

    public function open(): void
    {
        $this->isOpen = true;
    }

    public function close(): void
    {
        $this->isOpen = false;
    }

    public function applyFilter(?string $status): void
    {
        $this->statusFilter = $status;
        $this->dispatch('filterUpdated', $status);
        $this->close();
    }
}; ?>

<div>
    @if($isOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="p-6 bg-white rounded-lg shadow-lg w-96">
                <h2 class="mb-4 text-xl font-bold">Filter by Status</h2>

                <div class="space-y-2">
                    <button class="w-full px-4 py-2 bg-gray-200 rounded" wire:click="applyFilter(null)" wire:emit="filterUpdated, null">
                        All
                    </button>

                    @foreach (UserStatus::cases() as $status)
                        <button class="w-full py-2 px-4 rounded {{ $statusFilter === $status->name ? 'bg-blue-500 text-white' : 'bg-gray-200' }}"
                            wire:click="applyFilter('{{ $status->name }}')"
                            wire:emit="filterUpdated, '{{ $status->name }}'">
                            {{ $status->name }}
                        </button>
                    @endforeach
                </div>

                <button class="w-full px-4 py-2 mt-4 text-white bg-red-500 rounded" wire:click="close">
                    Cancel
                </button>
            </div>
        </div>
    @endif
</div>
