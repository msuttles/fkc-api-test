<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customerName', 50);
            $table->string('contactLastName', 50);
            $table->string('contactFirstName', 50);
            $table->string('phone', 50);
            $table->string('addressLine1', 50);
            $table->string('addressLine2', 50);
            $table->string('city', 50);
            $table->string('state', 50);
            $table->string('postalCode', 15);
            $table->string('country', 50);
            $table->integer('salesRepEmployeeNumber');
            $table->decimal('creditLimit', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
