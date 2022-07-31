<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use MKamelMasoud\Ads\Models\Ad;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id', 11)->key()->unsigned(false);
            $table->enum('type', ['free', 'paid'])->default('free');
            $table->string('name');
            $table->text('description');
            $table->foreignId('category_id')->index()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->index()->constrained()->onUpdate('cascade')->onDelete('cascade');
            
            $table->timestamp('start_date');
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
        Schema::dropIfExists('ads');
    }
}
