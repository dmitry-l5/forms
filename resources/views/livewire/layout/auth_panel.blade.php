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

<div class=" bg-slate-100 m-4 p-3 relative  border border-black box-border" x-data="{open:false}">
  
        <div  x-on:click="open = !open">
            <span class="">
                {{ Auth::user()->email }}
            </span>
        <div class="z-50  shadow shadow-neutral-500  w-full absolute left-0 bg-slate-100 p-3 border border-black " x-show='open' :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" >
            <div class="" wire:click='logout'>
                {{ __("Log out") }}
            </div>
        </div>
  </div>
</div>