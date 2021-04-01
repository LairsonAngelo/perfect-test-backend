<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->date('date');
            $table->decimal('discount');
            $table->string('status');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
