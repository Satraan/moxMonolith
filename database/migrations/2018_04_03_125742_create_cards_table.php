<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {

            //Core Card Fields
            $table->increments('id');
            $table->uuid('scryfall_id');
            $table->uuid('oracle_id')->nullable();
            $table->string('uri')->nullable();
            $table->string('scryfall_uri')->nullable();

            //Gameplay Fields
            $table->string('name');
            $table->decimal('cmc', 10)->nullable();
            $table->string('type_line')->nullable();
            $table->text('oracle_text')->nullable();
            $table->string('mana_cost')->nullable();
            $table->json('colors')->nullable();
            $table->json('color_identity')->nullable();

            // Print Fields
            $table->string('set');
            $table->string('set_name');
            $table->string('collector_number')->nullable();
            $table->json('image_uris')->nullable();
            $table->string('rarity')->nullable();

            $table->decimal('tcg_price')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
