<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectStatusTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create( 'project_status', function (Blueprint $table) {
			$table->increments( 'id' );
			$table->string( 'name' );
			$table->boolean('active');
			$table->string('abv');
			$table->timestamps();
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop( 'project_status' );
	}
}
