<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Reservation;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'totalCategories' => Category::count(),
            'totalProducts' => Product::count(),
            'totalReservations' => Reservation::count(),
            'latestReservations' => Reservation::latest('reservation_date')->take(5)->get(),
            'lowStockProducts' => Product::where('stock', '<=', 5)->orderBy('stock')->take(5)->get(),
        ]);
    }
}
