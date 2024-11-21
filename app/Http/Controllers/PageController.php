<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show()
    {
        // Logic to fetch and display adoptable pets
        return view('common.showAdpPet'); // Ensure this view file exists
    }

    public function donate()
    {
        // Logic to fetch and display adoptable pets
        return view('common.donation'); // Ensure this view file exists
    }

    public function showProfile() {
        return view('common.userProfile');
    }

}
