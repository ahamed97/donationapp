<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->string('name')->nullable()->change();
			$table->string('last_name')->nullable()->after('name');
			$table->string('phone')->nullable();
			$table->string('add_line_1')->nullable();
			$table->string('add_line_2')->nullable();
			$table->string('add_line_3')->nullable();
            $table->float('latitude', 10, 6)->nullable()->index();
			$table->float('longitude', 10, 6)->nullable()->index();
			$table->integer('vehicle_type_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('type')->nullable();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		Schema::table('users', function(Blueprint $table) {
			$table->dropColumn([
				'last_name',
				'phone',
				'add_line_1',
				'add_line_2',
				'add_line_3',
				'latitude',
				'longitude',
				'vehicle_type_id',
                'district_id',
                'type'
			]);
		});
	}
}
