<?php

namespace App\Livewire\Backend\Businesses;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Models\BusinessesModel;
use App\Services\ServiceFirestore;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Contract\Firestore;

class Businesses extends Component
{
     public function render()
    {
        return view('livewire.backend.businesses.businesses')
                    ->layout('layouts.app');
    }

}
