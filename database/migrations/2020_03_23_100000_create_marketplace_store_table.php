<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketplaceStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplace_store', function (Blueprint $table) {
            $table->primary(['store_id', 'marketplace_id']);
            $table->unsignedBigInteger('store_id')->index();
            $table->unsignedBigInteger('marketplace_id')->index();
            $table->timestamps();

            $table->foreign('marketplace_id')->references('id')->on('marketplaces')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marketplace_store');
    }
}
