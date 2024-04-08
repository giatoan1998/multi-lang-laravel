<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DataTagsController extends Controller
{
    public function getTags() {
        $tags = DB::table('tags')->first();
        return response()->json($tags);
    }
}
