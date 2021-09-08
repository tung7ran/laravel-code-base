<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

    /**
 * Class CreateBanksTable.
 */
class CreateBanksTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('banks', function(Blueprint $table) {
            $table->increments('id');
            $table->text('name_bank')->nullable();
            $table->text('name_account')->nullable();
            $table->text('bank_number')->nullable();
            $table->text('address')->nullable();
            $table->text('image')->nullable();
            $table->integer('status')->nullable();
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
		Schema::dropIfExists('banks');
	}
}
