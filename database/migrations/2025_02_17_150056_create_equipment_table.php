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
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("equipment_type_id")->nullable()->constrained("equipment_types")->nullOnDelete();
            $table->string("brand", 255);
            $table->string("model", 255);
            $table->date("acquired_date");
            $table->foreignId("section_id")->nullable()->constrained("sections")->nullOnDelete();
            $table->string("serial_number", 255);
            $table->string("mr_no", 255);
            $table->foreignId("person_accountable_id")->nullable()->constrained("person_accountables")->nullOnDelete();
            $table->string("remarks", 255);
            $table->timestamps();
            $table->index("brand");
            $table->index("model");
            $table->index("serial_number");
            $table->index("mr_no");
            $table->index("remarks");
            $table->index("created_at");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment');
    }
};
