<?php

use Livewire\Volt\Component;

new class extends Component
{
    public function logout(): void
    {
        auth()->guard('web')->logout();
        // Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        $this->redirect(url('/'), navigate: true);
    }
    public function to_form(): void
    {
        $this->redirect(url('form'));
    }
}; ?>

<div class="" x-data="{open:false}">
    <div  x-on:click="open = !open">
        <span class=" bg-slate-100 border">
            {{ Auth::user()->email }}
        </span>
    </div>
    <div class=" absolute bg-slate-100 w-40" x-show='open' :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" >
        <div class="" wire:click='logout'>
            {{ __("Log out") }}
        </div>
    </div>
</div>