<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId("equipment_id")->nullable()->constrained("equipments")->nullOnDelete();
            $table->date("date_of_transfer");
            $table->string("previous_location", 255);
            $table->string("previous_person");
            $table->string("transfer_location");
            $table->string("transfer_person");
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
        Schema::dropIfExists('transfer_history');
    }
};
