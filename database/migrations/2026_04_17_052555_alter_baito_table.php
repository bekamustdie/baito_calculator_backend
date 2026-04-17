<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('baito', function (Blueprint $table) {
            $table->renameColumn('time', 'start_time');
            $table->time("end_time")->after('start_time');
            $table->decimal('actual_work_hours', 4,2)->after('end_time');
            $table->smallInteger('hour_pay')->after('actual_work_hours');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
