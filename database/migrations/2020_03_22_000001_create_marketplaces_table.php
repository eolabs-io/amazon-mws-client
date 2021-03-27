<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMwsClient\Shared\Migrations\AmazonMwsClientMigration;

class CreateMarketplacesTable extends AmazonMwsClientMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplaces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('marketplace_id');
            $table->string('name');
            $table->string('default_country_code');
            $table->string('default_currency_code');
            $table->string('default_language_code');
            $table->string('domain_name');
            $table->timestamps();

            $table->unique(['marketplace_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marketplaces');
    }
}
