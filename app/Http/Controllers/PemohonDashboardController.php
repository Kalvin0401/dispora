<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Fasilitas;
use Illuminate\Support\Facades\Auth;

class PemohonDashboardController extends Controller
{
   public function index()
{
    $user = Auth::user();

    $latest = Peminjaman::where('user_id', $user->id)
                ->latest()
                ->first();

    $step = 1;

    if ($latest) {

        switch ($latest->status) {

            case 'menunggu':
                $step = 1;
                break;

            case 'disetujui':
                $step = 2;
                break;

            case 'dibayar':
                $step = 3;
                break;

            case 'dipinjam':
            case 'menunggu_pengembalian':
                $step = 4;
                break;

            case 'selesai':
                $step = 5;
                break;

            case 'ditolak':
                $step = 1;
                break;

            default:
                $step = 1;
        }
    }

    return view('pemohon.dashboard', compact('latest', 'step'));

    }
}
