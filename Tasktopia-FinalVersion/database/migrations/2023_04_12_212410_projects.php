<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->string('name', 200)->default('');
            $table->text('description')->default('');
            $table->tinyInteger('status')->default('');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('manager_id');
            $table->text('user_ids')->default('');
            $table->timestamp('date_created')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
