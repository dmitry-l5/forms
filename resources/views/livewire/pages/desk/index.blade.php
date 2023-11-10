<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

use App\Models\Answers;

new 
    #[Layout('layouts.app_2')] 
class extends Component
{
    use WithPagination;
    public function with(){
        return ['answers' => Answers::paginate(10), ];
    }

}; ?>

<div class="">
    <div class="">
        {{ Auth::user()->id ?? '0'}}
    </div>
    @foreach ( $answers as $answer)
    {{ var_dump($answer->created_at->format('d-m-Y h-i')) }}
    <br>
    <br>
    @endforeach
    {{ $answers->links() }}

</div>