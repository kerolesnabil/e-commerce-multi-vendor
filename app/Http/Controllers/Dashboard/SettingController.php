<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function updateShippingMethods(ShippingsRequest $request,$id)
    {
        //validation

        //db update

        try{
            $shippingMethod= Setting::findOrFail($id);

            DB::beginTransaction();
            $shippingMethod->update([
                'plain_value'=>$request->plain_value,
                'value'=>$request->value,
            ]);
            //save translation

            $shippingMethod->value=$request->value;
            $shippingMethod->save();

            DB::commit();

            return redirect()->back()->with(['success'=>'update successfully']);

        }catch (\Exception $e){
            return redirect()->back()->with(['error'=>'update error']);
            DB::rollBack();
        }



    }

}
