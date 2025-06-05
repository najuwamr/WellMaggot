<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Alamat;
use App\Models\DetailAlamat;
use App\Models\Kecamatan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function show(): View
    {
        $user = Auth::user();
        $alamatList = DetailAlamat::with('alamat.kecamatan')->where('user_id', $user->id)->get();

        return view('profile.show', [
            'user' => $user,
            'alamatList' => $alamatList,
        ]);
    }

    public function edit(Request $request): View
    {
        $user = $request->user();
        $alamatList = DetailAlamat::with('alamat.kecamatan')->where('user_id', $user->id)->get();
        $kecamatanList = Kecamatan::all();

        return view('profile.edit', [
            'user' => $user,
            'alamatList' => $alamatList,
            'kecamatanList' => $kecamatanList,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updateAlamat(Request $request, $id)
    {
        $detail = DetailAlamat::findOrFail($id);
        $alamat = $detail->alamat;

        $alamat->update([
            'jalan' => $request->input('jalan'),
            'kecamatan_id' => $request->input('kecamatan_id'),
        ]);

        return redirect()->route('profile.edit')->with('status', 'Alamat diperbarui.');
    }

    public function destroyAlamat($id)
    {
        $detail = DetailAlamat::findOrFail($id);
        $detail->delete();

        return redirect()->route('profile.edit')->with('status', 'Alamat dihapus.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
