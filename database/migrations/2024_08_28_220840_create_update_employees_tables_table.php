<?php
// database/migrations/xxxx_xx_xx_update_employees_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('location_code')->nullable()->change(); // Change location_code to be a foreign key
            $table->foreign('location_code')->references('code')->on('locations')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['location_code']);
            $table->string('location_code')->change();
        });
    }
}
