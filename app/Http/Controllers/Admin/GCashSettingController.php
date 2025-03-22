<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use App\Models\GCashSetting;


class GCashSettingController extends Controller
{
    public function index()
    {
        $gcashSetting = GCashSetting::first();
        return view('admin.gcash_settings.index', compact('gcashSetting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'qr_code' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $gcashSetting = GCashSetting::firstOrCreate([]);

        if ($request->hasFile('qr_code')) {
            // Delete the old QR code if it exists
            if ($gcashSetting->qr_code) {
                Storage::delete($gcashSetting->qr_code);
            }

            // Store the new QR code
            $path = $request->file('qr_code')->store('gcash_qr_codes', 'public');
            $gcashSetting->qr_code = $path;
        }

        $gcashSetting->save();

        return redirect()->back()->with('success', 'GCash QR Code updated successfully!');
    }
}
