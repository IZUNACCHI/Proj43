<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFundamentacaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fundamentacao', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('fundamentacao')->nullable();
			$table->integer('user_id')->unsigned()->index('user_id_foreign');
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
		Schema::drop('fundamentacao');
	}

}
