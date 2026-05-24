<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index()
    {
        // Menampilkan halaman transaksi admin
        return view('admin.transactions.index');
    }
}