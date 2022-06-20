<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function editShippingMethods($type)
    {
        //free,inner,outer for shipping methods

       if($type==='inner')
        {
            $shippingMethods=Setting::where('key','local_label')->first();
        }
        elseif($type==='outer')
        {
            $shippingMethods=Setting::where('key','outer_label')->first();
        }
        else
        {
            $shippingMethods=Setting::where('key','free_shipping_label')->first();
        }

        return view('dashboard.settings.shippings.edit')->with(['shippingMethods'=>$shippingMethods]);

    }

    public function updateShippingMethods(Request $request,$id)
    {

    }

}
