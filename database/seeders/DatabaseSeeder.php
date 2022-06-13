<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Lang;
use App\Models\PaymentGateway;
use App\Models\PaymentMethod;
use App\Models\PaymentRule;
use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \Schema::disableForeignKeyConstraints();

        Lang::truncate();
        Lang::insertOrIgnore([
            ['code' => 'ru', 'name' => 'Русский'],
            ['code' => 'en', 'name' => 'English'],
            ['code' => 'es', 'name' => 'Español'],
            ['code' => 'uk', 'name' => 'Українська'],
        ]);

        ProductType::truncate();
        ProductType::insertOrIgnore([
            ['code' => 'book'],
            ['code' => 'reward'],
            ['code' => 'walletRefill'],
        ]);

        Country::truncate();
        Country::insertOrIgnore([
            ['code' => 'UA', 'name' => 'Украина'],
            ['code' => 'TR', 'name' => 'Турция'],
            ['code' => 'IN', 'name' => 'Индия'],
            ['code' => 'EG', 'name' => 'Египет'],
            ['code' => 'GE', 'name' => 'Грузия'],
        ]);

        PaymentGateway::truncate();
        PaymentGateway::insertOrIgnore([
            ['name' => 'Интеркасса', 'is_enabled' => true],
            ['name' => 'Yandex.Kassa', 'is_enabled' => true],
            ['name' => 'CardPay', 'is_enabled' => false],
            ['name' => 'Wallet', 'is_enabled' => true],
        ]);

        PaymentMethod::truncate();
        PaymentMethod::insertOrIgnore([
            ['name' => 'Приват банк', 'payment_gateway_id' => 1, 'is_enabled' => true],
            ['name' => 'Банковская карта', 'payment_gateway_id' => 1, 'is_enabled' => true],
            ['name' => 'PayPal', 'payment_gateway_id' => 2, 'is_enabled' => true],
            ['name' => 'Wallet', 'payment_gateway_id' => 4, 'is_enabled' => true],
            ['name' => 'ApplePay', 'payment_gateway_id' => 1, 'is_enabled' => true],
            ['name' => 'GooglePay', 'payment_gateway_id' => 1, 'is_enabled' => true],
        ]);

        PaymentRule::truncate();
        PaymentRule::insertOrIgnore([
            ['payment_method_id' => 1, 'product_type' => null, 'amount' => null, 'lang_code' => null,  'country_filter_type' => PaymentRule::TYPE_SHOW, 'user_os' => null, 'type' => PaymentRule::TYPE_SHOW],
            ['payment_method_id' => 3, 'product_type' => null, 'amount' => '30', 'lang_code' => 'ru', 'country_filter_type' => null, 'user_os' => null, 'type' => PaymentRule::TYPE_SHOW],
            ['payment_method_id' => 4, 'product_type' => 'reward', 'amount' => '10', 'lang_code' => 'ru', 'country_filter_type' => null, 'user_os' => null, 'type' => PaymentRule::TYPE_HIDE_OTHERS],
            ['payment_method_id' => 6, 'product_type' => null, 'amount' => null, 'lang_code' => null, 'country_filter_type' => PaymentRule::TYPE_HIDE, 'user_os' => 'android', 'type' => PaymentRule::TYPE_SHOW],
            ['payment_method_id' => 5, 'product_type' => null, 'amount' => null, 'lang_code' => null, 'country_filter_type' => null, 'user_os' => 'ios', 'type' => PaymentRule::TYPE_SHOW],
            ['payment_method_id' => 4, 'product_type' => 'walletRefill', 'amount' => null, 'lang_code' => null, 'country_filter_type' => null, 'user_os' => null, 'type' => PaymentRule::TYPE_HIDE],
        ]);
    }
}
