<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profile
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update profile user
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $data = $request->validated();

        // Jika email berubah, reset verifikasi
        if ($user->email !== $data['email']) {
            $data['email_verified_at'] = null;
        }

        // 🔥 HANDLE UPLOAD FOTO
        if ($request->hasFile('foto')) {

            // Hapus foto lama (jika ada)
            if ($user->foto && Storage::exists('public/foto/' . $user->foto)) {
                Storage::delete('public/foto/' . $user->foto);
            }

            // Simpan foto baru
            $file = $request->file('foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('public/foto', $namaFile);

            $data['foto'] = $namaFile;
        }

        // Update user
        $user->update($data);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Hapus akun user
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Hapus foto jika ada
        if ($user->foto && Storage::exists('public/foto/' . $user->foto)) {
            Storage::delete('public/foto/' . $user->foto);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}