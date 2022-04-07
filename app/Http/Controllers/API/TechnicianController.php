<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Technician;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    public function getIndex()
    {
        $data = Technician::get();
        return response()->json([
            'data'  => $data
        ]);
    }
}
