<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_rules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('payment_method_id')
                ->constrained('payment_methods')
                ->restrictOnDelete();

            $table->string('product_type', 50);
            $table->float('amount')->nullable();
            $table->char('lang_code', 2)->nullable();
            $table->string('country_filter_type', 50);
            $table->string('user_os', 50);
            $table->string('type', 50);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_rules');
    }
};
