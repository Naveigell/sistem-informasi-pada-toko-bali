<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('address', 255);
            $table->string('phone', 30);
            $table->string('shipping_service', 30);
            $table->string('province', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('courier', 255)->nullable();
            $table->string('zip', 20)->nullable();
            $table->unsignedInteger('cost');
            $table->foreignId('area_id')->nullable()->constrained('shipping_costs')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('shippings');
    }
}
