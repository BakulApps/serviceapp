<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityServiceappTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity__settings', function (Blueprint $table) {
            $table->id('seting_id');
            $table->string('setting_name');
            $table->string('setting_value');
        });

        Schema::create('entity__master_units', function (Blueprint $table) {
            $table->id('unit_id');
            $table->string('unit_nopol');
            $table->string('unit_merk')->nullable();
            $table->string('unit_type')->nullable();
            $table->string('unit_year')->nullable();
            $table->string('unit_region')->nullable();
        });

        Schema::create('entity__master_garages', function (Blueprint $table) {
            $table->id('garage_id');
            $table->string('garage_name');
            $table->string('garage_address')->nullable();
            $table->string('garage_phone')->nullable();
        });

        Schema::create('entity__transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->integer('transaction_unit');
            $table->integer('transaction_garage');
            $table->string('transaction_customer')->nullable();
            $table->string('transaction_phone')->nullable();
            $table->string('transaction_desc')->nullable();
            $table->string('transaction_desc_finish')->nullable();
            $table->date('transaction_date_in')->nullable();
            $table->date('transaction_date_finish')->nullable();
            $table->string('transaction_status')->default(1)->nullable();
            $table->boolean('transaction_stiker')->nullable();
            $table->boolean('transaction_apar')->nullable();
        });

        Schema::create('entity__emisis', function (Blueprint $table) {
            $table->id('emisi_id');
            $table->integer('emisi_transaction');
            $table->string('emisi_co')->nullable();
            $table->string('emisi_hc')->nullable();
            $table->string('emisi_co2')->nullable();
            $table->string('emisi_o2')->nullable();
            $table->string('emisi_lamda')->nullable();
        });

        Schema::create('entity__users', function (Blueprint $table){
            $table->id('user_id');
            $table->string('user_name');
            $table->string('user_pass');
            $table->string('user_fullname');
            $table->string('user_address');
            $table->string('user_image')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entity__settings');
        Schema::dropIfExists('entity__master_units');
        Schema::dropIfExists('entity__master_garages');
        Schema::dropIfExists('entity__transactions');
        Schema::dropIfExists('entity__emisis');
        Schema::dropIfExists('entity__users');
    }
}
