<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
			$table->unsignedBigInteger('department_id')->nullable()->change();
			$table->string('employee_code', 50)->nullable()->change();
			$table->string('phone', 20)->nullable()->change();
			$table->string('address')->nullable()->change();
			$table->date('birthdate')->nullable()->change();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
