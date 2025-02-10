<?php

use Livewire\WithPagination;
use Livewire\Volt\Component;
use App\Models\User;

new class extends Component {
    use WithPagination;

    public string $search = '';

    public string $sortDirection = 'asc';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function sortByName(): void
    {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function with(): array
    {
        return [
            'users' => User::query()
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->orderBy('name', $this->sortDirection)
                ->paginate(10),
        ];
    }
} ?>

<div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white border shadow-md rounded-xl bg-clip-border-[#E4E4E4] p-4">
    <div class="flex items-center justify-between p-4">
        <div class="inline-block">
            <span class="text-4xl font-bold">Investors</span>
        </div>
        <div class="flex items-center space-x-2">
            <div class="mr-2">
                <x-text-input
                    id="search"
                    class="bg-transparent border border-gray-300 rounded-lg focus:border-[#7839CD] focus:ring-1 focus:ring-[#7839CD] transition-colors"
                    type="text"
                    name="search"
                    wire:model.live="search"
                    placeholder="Search"
                    required
                    autofocus
                />
            </div>
            <div>
                <x-primary-button
                    class="py-3"
                    style="background-color: #F4EEFB; border-color: #7839CD; color: #7839CD;"
                >
                    Filter
                </x-primary-button>
            </div>
            <div>
                <x-primary-button
                    class="py-3"
                    style="background-color: #7839CD; border-color: #7839CD; color: #F4EEFB;"
                >
                    <x-heroicon-s-arrow-down-tray class="w-5"/>
                </x-primary-button>
            </div>
        </div>
    </div>

    <div class="border shadow-md rounded-xl bg-clip-border-[#E4E4E4] mt-4">
        <table class="w-full text-left table-auto min-w-max">
            <thead>
                <tr>
                    <th colspan="2" class="items-center justify-between p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                        <div class="flex justify-between">
                            <p class="font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">Users</p>
                            <button wire:click="sortByName" > <x-heroicon-c-chevron-up-down class="w-5"/> </button>
                        </div>
                    </th>
                    <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                        <p class="font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">Status</p>
                    </th>
                    <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                        <p class="font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">E-mail</p>
                    </th>
                    <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                        <p class="font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">Date</p>
                    </th>
                    <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50"></th>
                    <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="border-b border-blue-gray-100">
                            <div class="flex justify-end">
                                @if ($user->profile_photo)
                                    <img src="{{ $user->profile_photo }}" alt="Foto de {{ $user->name }}" class="h-12 rounded-full w-14">
                                @else
                                    <img src="{{ \App\Helpers\AvatarHelper::generateAvatarUrl($user->name) }}" alt="Avatar de {{ $user->name }}" class="h-12 w-14">
                                @endif
                            </div>
                        </td>
                        <td class="border-b border-blue-gray-100">
                            <p class="font-sans antialiased leading-normal text-blue-gray-900">
                                <span class="text-base font-bold text-black">
                                    {{ $user->name }}
                                </span>
                                <br>
                                <span class="text-sm text-gray-600">
                                    {{ '@' . $user->username }}
                                </span>
                            </p>
                        </td>
                        <td class="p-4 border-b border-blue-gray-100">
                            @php
                                $statusColors = match($user->status) {
                                    \App\Enums\UserStatus::Active => 'bg-[#E9FFEF] text-green-700',
                                    \App\Enums\UserStatus::Pending => 'bg-orange-100 text-orange-700',
                                    \App\Enums\UserStatus::Disabled => 'bg-gray-100 text-gray-700',
                                };
                            @endphp

                            <span class="pl-1 pr-2 py-1 text-base rounded-full nowrap flex justify-center {{ $statusColors }}">
                                <x-tabler-point-filled /> {{ $user->status->name }}
                            </span>
                        </td>
                        <td class="p-4 border-b border-blue-gray-100">
                            <p class="font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                {{ $user->email }}
                            </p>
                        </td>
                        <td class="p-4 border-b border-blue-gray-100">
                            <p class="font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                {{ \Carbon\Carbon::parse($user->date)->format('n/j/y') }}
                            </p>
                        </td>
                        <td class="p-4 space-x-2 border-b tems-center border-blue-gray-100">
                            <a href="#" class="font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900">
                                <x-css-info class="text-[#959595]"/>
                            </a>
                        </td>
                        <td class="p-4 space-x-2 border-b tems-center border-blue-gray-100">
                            <a href="#" class="font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900">
                                <x-css-trash class="text-[#959595]"/>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex justify-center mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
