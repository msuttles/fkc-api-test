<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HumanaSamples extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('AllPlanTypes', function (Blueprint $table) {
            $table->integer('Order', 11);
            $table->string('PY Plan', 255);
            $table->string('CY Plan', 255);
            $table->string('Product Type', 255);
            $table->string('SNP Type', 255);
            $table->string('Combo', 255);
            $table->string('Priority', 255);
            $table->string('State', 255);
            $table->string('County', 255);
            $table->string('State-County', 255);
            $table->string('FIPS', 11);
            $table->string('Premium', 20);
            $table->integer('Membership', 11);
            $table->string('Lookup', 255);
            $table->integer('Rank', 11);
        });
        Schema::create('HMO', function (Blueprint $table) {
            $table->integer('Order', 11);
            $table->string('PY Plan', 255);
            $table->string('CY Plan', 255);
            $table->string('Product Type', 255);
            $table->string('SNP Type', 255);
            $table->string('Combo', 255);
            $table->string('Priority', 255);
            $table->string('State', 255);
            $table->string('County', 255);
            $table->string('State-County', 255);
            $table->string('FIPS', 11);
            $table->string('Premium', 20);
            $table->integer('Membership', 11);
            $table->string('Lookup', 255);
            $table->integer('Points', 11);
            $table->integer('Rank', 11);
        });
        Schema::create('LPPO', function (Blueprint $table) {
            $table->integer('Order', 11);
            $table->string('PY Plan', 255);
            $table->string('CY Plan', 255);
            $table->string('Product Type', 255);
            $table->string('SNP Type', 255);
            $table->string('Combo', 255);
            $table->string('Priority', 255);
            $table->string('State', 255);
            $table->string('County', 255);
            $table->string('State-County', 255);
            $table->string('FIPS', 11);
            $table->string('Premium', 20);
            $table->integer('Membership', 11);
            $table->string('Lookup', 255);
            $table->integer('Points', 11);
            $table->integer('Rank', 11);
        });
        Schema::create('PPO', function (Blueprint $table) {
            $table->integer('Order', 11);
            $table->string('PY Plan', 255);
            $table->string('CY Plan', 255);
            $table->string('Product Type', 255);
            $table->string('SNP Type', 255);
            $table->string('Combo', 255);
            $table->string('Priority', 255);
            $table->string('State', 255);
            $table->string('County', 255);
            $table->string('State-County', 255);
            $table->string('FIPS', 11);
            $table->string('Premium', 20);
            $table->integer('Membership', 11);
            $table->string('Lookup', 255);
            $table->integer('Points', 11);
            $table->integer('Rank', 11);
        });
        Schema::create('RankedData', function (Blueprint $table) {
            $table->integer('Order', 11);
            $table->string('PY Plan', 255);
            $table->string('CY Plan', 255);
            $table->string('Product Type', 255);
            $table->string('SNP Type', 255);
            $table->string('Combo', 255);
            $table->string('Priority', 255);
            $table->string('State', 255);
            $table->string('County', 255);
            $table->string('State-County', 255);
            $table->string('FIPS', 11);
            $table->string('Premium', 20);
            $table->integer('Membership', 11);
            $table->string('Lookup', 255);
            $table->integer('Points', 11);
            $table->integer('Rank', 11);
        });
        Schema::create('RankedHMO', function (Blueprint $table) {
            $table->integer('Order', 11);
            $table->string('PY Plan', 255);
            $table->string('CY Plan', 255);
            $table->string('Product Type', 255);
            $table->string('SNP Type', 255);
            $table->string('Combo', 255);
            $table->string('Priority', 255);
            $table->string('State', 255);
            $table->string('County', 255);
            $table->string('State-County', 255);
            $table->string('FIPS', 11);
            $table->string('Premium', 20);
            $table->integer('Membership', 11);
            $table->string('Lookup', 255);
            $table->integer('Points', 11);
            $table->integer('Rank', 11);
        });
        Schema::create('RankedPPO', function (Blueprint $table) {
            $table->integer('Order', 11);
            $table->string('PY Plan', 255);
            $table->string('CY Plan', 255);
            $table->string('Product Type', 255);
            $table->string('SNP Type', 255);
            $table->string('Combo', 255);
            $table->string('Priority', 255);
            $table->string('State', 255);
            $table->string('County', 255);
            $table->string('State-County', 255);
            $table->string('FIPS', 11);
            $table->string('Premium', 20);
            $table->integer('Membership', 11);
            $table->string('Lookup', 255);
            $table->integer('Points', 11);
            $table->integer('Rank', 11);
        });
        Schema::create('RankedLPPO', function (Blueprint $table) {
            $table->integer('Order', 11);
            $table->string('PY Plan', 255);
            $table->string('CY Plan', 255);
            $table->string('Product Type', 255);
            $table->string('SNP Type', 255);
            $table->string('Combo', 255);
            $table->string('Priority', 255);
            $table->string('State', 255);
            $table->string('County', 255);
            $table->string('State-County', 255);
            $table->string('FIPS', 11);
            $table->string('Premium', 20);
            $table->integer('Membership', 11);
            $table->string('Lookup', 255);
            $table->integer('Points', 11);
            $table->integer('Rank', 11);
        });
        Schema::create('RankedRPPO', function (Blueprint $table) {
            $table->integer('Order', 11);
            $table->string('PY Plan', 255);
            $table->string('CY Plan', 255);
            $table->string('Product Type', 255);
            $table->string('SNP Type', 255);
            $table->string('Combo', 255);
            $table->string('Priority', 255);
            $table->string('State', 255);
            $table->string('County', 255);
            $table->string('State-County', 255);
            $table->string('FIPS', 11);
            $table->string('Premium', 20);
            $table->integer('Membership', 11);
            $table->string('Lookup', 255);
            $table->integer('Points', 11);
            $table->integer('Rank', 11);
        });
        Schema::create('RPPO', function (Blueprint $table) {
            $table->integer('Order', 11);
            $table->string('PY Plan', 255);
            $table->string('CY Plan', 255);
            $table->string('Product Type', 255);
            $table->string('SNP Type', 255);
            $table->string('Combo', 255);
            $table->string('Priority', 255);
            $table->string('State', 255);
            $table->string('County', 255);
            $table->string('State-County', 255);
            $table->string('FIPS', 11);
            $table->string('Premium', 20);
            $table->integer('Membership', 11);
            $table->string('Lookup', 255);
            $table->integer('Points', 11);
            $table->integer('Rank', 11);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('AllPlanTypes');
        Schema::dropIfExists('HMO');
        Schema::dropIfExists('LPPO');
        Schema::dropIfExists('PPO');
        Schema::dropIfExists('RankedData');
        Schema::dropIfExists('RankedHMO');
        Schema::dropIfExists('RankedLPPO');
        Schema::dropIfExists('RankedPPO');
        Schema::dropIfExists('RankedRPPO');
        Schema::dropIfExists('RPPO');
    }
}
