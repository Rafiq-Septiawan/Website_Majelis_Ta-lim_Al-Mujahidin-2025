<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        return view('admin.notifications');
    }

    public function fetch()
    {
        $pembayaran = Pembayaran::where('status', 'lunas')
            ->orderBy('updated_at', 'desc')
            ->get(['id', 'nama_santri', 'bulan', 'jumlah_bayar', 'updated_at']);

        $santriBaru = User::where('role', 'santri')
            ->orderBy('created_at', 'desc')
            ->get(['id', 'name', 'created_at']);

        return response()->json([
            'pembayaran' => $pembayaran,
            'santriBaru' => $santriBaru,
        ]);
    }
}
