<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMwsClient\Shared\Migrations\AmazonMwsClientMigration;

class CreateStoresTable extends AmazonMwsClientMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('aws_access_key_id');
            $table->string('mws_auth_token');
            $table->string('secret_key');
            $table->string('seller_id');
            $table->string('amazon_service_url');
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
        Schema::dropIfExists('stores');
    }
}
