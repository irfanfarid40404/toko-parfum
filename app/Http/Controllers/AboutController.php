<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class AboutController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('About', [
            'appName' => config('app.name'),
            'laravelVersion' => app()->version(),
            'features' => [
                'Manajemen produk parfum',
                'Pengelolaan kategori parfum',
                'Pengelolaan pesanan pelanggan',
            ],
        ]);
    }
}
