<?php

use App\Providers\RouteServiceProvider;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.blank')] class extends Component
{
    public function sendVerification(): void
    {
        if (auth()->user()->hasVerifiedEmail()) {
            $this->redirect(
                session('url.intended', RouteServiceProvider::HOME),
                navigate: true
            );

            return;
        }

        auth()->user()->sendEmailVerificationNotification();

        session()->flash('status', 'verification-link-sent');
    }

    public function logout(): void
    {
        auth()->guard('web')->logout();

        session()->invalidate();
        session()->regenerateToken();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div>
    <div class="mb-4 text-sm text-gray-600">
        Перед исспользованием сервиса, пожалуйста, подтвердите Email адрес указанный при регистрацыи.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            Новая ссылка поддтверждения Email была отправлена на адрес указанный при регистрации.
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <x-buttons.primary wire:click="sendVerification">
            Отправить ссылку для  <br> подтверждения, email ещё раз.
        </x-buttons.primary>

        <button wire:click="logout" type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Выход
        </button>
    </div>
</div>
