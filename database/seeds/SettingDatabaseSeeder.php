<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;


class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::setMany([
            'default_locale'=>'ar',
            'default_timezone'=>'Africa/cairo',
            'reviews_enabled'=>true,
            'auto_approve_reviews'=>true,
            'supported_currency'=>['USD','LE','SAR'],
            'default_currency'=>'USD',
            'store_email'=>'admin@ecommer.com',
            'search_engine'=>'mysql',
            'local_shipping_cost'=>0,
            'outer_shipping_cost'=>0,
            'free_shipping_cost'=>0,
            'translatable'=>[
                'store_name'=>'keroles Store',
                'free_shipping_label'=>'Free Shipping',
                'local_label'=>'local shipping',
                'outer_label'=>'outer shipping',
            ]

        ]);
    }
}
