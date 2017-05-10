<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabulkaRezervacisTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tabulka_rezervacis', function (Blueprint $table) {
			$table->increments('id')->unique();
			$table->integer('user_id')->default(1);
			$table->dateTime('datum')->unique();
			$table->text('nazev');
			$table->text('poznamka')->nullable();
			$table->integer('telefon');
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
		Schema::dropIfExists('tabulka_rezervacis');
	}
}
