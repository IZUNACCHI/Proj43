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
        Schema::create('vencimentos', function (Blueprint $table){
            $table->increments('id');
            $table->string('descricao')->nullable();
            $table->decimal('remuneracao', 6, 2)->nullable();
            $table->string('escalao')->nullable();
            $table->string('indice')->nullable();
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::drop('vencimentos');
	}

}
