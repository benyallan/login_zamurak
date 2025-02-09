<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'name' => '',
    'email' => '',
    'password' => '',
    'password_confirmation' => ''
]);

rules([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
]);

$register = function () {
    $validated = $this->validate();

    $validated['password'] = Hash::make($validated['password']);

    event(new Registered($user = User::create($validated)));

    Auth::login($user);

    $this->redirect(route('dashboard', absolute: false), navigate: true);
};

?>

<div>
    <img src="{{ asset('storage/images/fundo_register.png') }}" alt="" class="absolute top-0 left-0 object-cover w-full h-full">
    <div class="absolute top-0 left-0 z-20 flex items-center justify-center w-1/2 h-full">
        <form wire:submit="register">
            <div class="flex items-center justify-center">
                <span class="text-5xl font-bold mb-14">Register</span>
            </div>

            <!-- Username -->
            <div class="mt-4">
                <x-input-label class="text-[#7c838a]" for="username" value="Username" />
                <x-text-input wire:model="username" id="username"
                            class="block w-full mt-1 bg-transparent border-[#656ed3] text-[#afb3ff]"
                            type="text"
                            name="username"
                            required
                            style="border-radius: 999px"
                            autocomplete="username" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label class="text-[#7c838a]" for="password" :value="__('Password')" />

                <x-text-input wire:model="password" id="password" class="block w-full mt-1 bg-transparent border-[#656ed3] text-[#afb3ff]"
                                type="password"
                                name="password"
                                style="border-radius: 999px"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label class="text-[#7c838a]" for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block w-full mt-1 bg-transparent border-[#656ed3] text-[#afb3ff]"
                                type="password"
                                style="border-radius: 999px"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="block w-full py-3 mt-3 rounded-full" style="border-radius: 999px">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
