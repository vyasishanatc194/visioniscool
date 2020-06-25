<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefefilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refefiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('refe_table_field_name', 55);
            $table->integer('refe_field_id')->default(0);
			$table->string('refe_file_path', 250)->nullable();
            $table->string('refe_file_name', 250)->nullable();
            $table->string('refe_file_real_name', 250)->nullable();
            $table->string('refe_type', 150)->nullable();
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
        Schema::dropIfExists('refefiles');
    }
}
