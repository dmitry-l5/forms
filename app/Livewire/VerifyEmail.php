<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VerifyEmail extends Component
{
    public function sendVerification():void {
        if(Auth::user()->hasVerifiedEmail()){
            $this->redirect('/');
            return;
        }
        $this->message = 'email not veryfied';
        auth()->user()->sendEmailVerificationNotification();
        session()->flash('status', 'verification-link-sent');
    }
    public function logout(): void {
        auth()->guard('web')->logout();
        session()->invalidate();
        session()->regenerateToken();
        $this->redirect('/', navigate: true);
    }


    public function render() {
        return view('livewire.verify-email');
    }
}
