<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function settings(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('logo')) {
            delete_file(setting()->logo);
            $data['logo'] = store_file($request->logo, 'settings');
        } else {
            $data['logo'] = setting()->logo;
        }

        if ($request->hasFile('icon')) {
            delete_file(setting()->icon);
            $data['icon'] = store_file($request->icon, 'settings');
        } else {
            $data['icon'] = setting()->icon;
        }
        $data['new_invoice_form'] = $request->new_invoice_form ? 1 : 0;
        $data['payment_gateways'] = $request->payment_gateways ? 1 : 0;
        $data['complaint'] = $request->complaint ? 1 : 0;
        $data['activate_birthdate'] = $request->activate_birthdate ? 1 : 0;
        $data['active_transfer_print'] = $request->active_transfer_print ? 1 : 0;
        setting()->update($data);
        return back()->with('success', __('Successfully updated'));
    }
}
