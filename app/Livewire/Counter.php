<?php

namespace App\Livewire;

use App\Models\Group;
use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Counter extends Component
{
    #[Layout('components.layouts.app')]
    public $count = 1;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
