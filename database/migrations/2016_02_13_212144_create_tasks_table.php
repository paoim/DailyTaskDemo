<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create ( 'tasks', function (Blueprint $table) {
			$table->increments( 'id' );
			$table->integer( 'user_id' )->index();
			$table->integer( 'project_id' )->index();
			$table->integer( 'task_status_id' )->index();
			$table->string( 'name' );
			$table->text('description');
			$table->timestamp('closed_at');
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
		Schema::drop ( 'tasks' );
	}
}
