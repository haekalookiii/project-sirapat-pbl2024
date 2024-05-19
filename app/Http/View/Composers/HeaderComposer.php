<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class HeaderComposer
{
    public function compose(View $view)
    {
        // Mengambil pengguna yang sedang login
        $user = auth()->user();

        // Inisialisasi $foto_profil dengan null secara default
        $foto_profil = null;

        // Periksa apakah pengguna memiliki profil siswa dan foto profil tersedia
        if ($user && $user->student && $user->student->foto_profil) {
            // Jika iya, atur $foto_profil sesuai dengan foto profil pengguna
            $foto_profil = $user->student->foto_profil;
        }

        // Melewatkan data foto profil ke view header
        $view->with('foto_profil', $foto_profil);
    }
}
