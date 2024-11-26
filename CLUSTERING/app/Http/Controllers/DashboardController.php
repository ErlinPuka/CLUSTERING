<?php

namespace App\Http\Controllers;

use App\Models\TbClustering;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index()
   {
      return view('dashboard');
   }

   public function index_user()
   {
      $hasil = TbClustering::all();
      return view('index', compact('hasil'));
   }
}
