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

<div class="p-0 m-0 border-0 hover:bg-sky-500" x-data="{open:false}">
    <div class=" h-full text-white box-border px-4 py-2" >
        <div class=" h-full flex justify-center items-center" x-on:click="open = !open">
            <div>
                {{ Auth::user()->email }}
            </div>
        </div>
    </div>
    <div class="relative p-0 m-0 h-0">
            <div  class=" z-50 bg-white w-full absolute left-0 top-[5px] border-black border " x-show='open' :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" >
                <div class=" px-2 py-1  border-b hover:bg-sky-500 hover:text-white" wire:click='logout'>
                    Выйти
                </div>
            </div>
    </div>
</div>