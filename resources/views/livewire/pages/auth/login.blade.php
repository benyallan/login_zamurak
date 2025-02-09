<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.guest');

form(LoginForm::class);

$login = function () {
    $this->validate();

    $this->form->authenticate();

    Session::regenerate();

    $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
};

?>

<div class="relative w-screen h-screen">
    <div class="bg-[#ced7f8] h-14 w-full absolute left-0 z-10 flex items-center pl-12">
        <span class="text-4xl font-medium">Portal</span>
    </div>
    <img src="{{ asset('storage/images/fundo_login.png') }}" alt="" class="absolute top-0 left-0 object-cover w-full h-full">
    <div class="absolute top-0 right-0 z-20 flex items-center justify-center w-1/2 h-full">
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form wire:submit="login">
            <div class="flex items-center justify-center">
                <span class="text-5xl font-bold mb-14">Login</span>
            </div>
            <div>
                <x-input-label class="text-[#7c838a]" for="username" value="Username" />
                <x-text-input wire:model="form.username" id="username" class="block w-full mt-1 bg-transparent border-[#656ed3] text-[#afb3ff]"
                                type="text"
                                name="username"
                                required
                                autofocus
                                style="border-radius: 999px"
                                autocomplete="username" />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label class="text-[#7c838a]" for="password" :value="__('Password')" />

                <x-text-input wire:model="form.password" id="password" class="block w-full mt-1 bg-transparent border-[#656ed3] text-[#afb3ff]"
                                type="password"
                                name="password"
                                style="border-radius: 999px"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('form.password')" class="mt-2 rounded-full" />
            </div>

            <div class="flex justify-center mt-4 itfullems-center">
                <x-primary-button class="block w-full py-3 mt-3 rounded-full" style="border-radius: 999px">
                    Login
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
