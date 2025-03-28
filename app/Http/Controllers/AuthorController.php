<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function store()
    {
        $data = Author::create(
            request()->only([
                'name',
                'dob'
            ])
        );
    }
}
