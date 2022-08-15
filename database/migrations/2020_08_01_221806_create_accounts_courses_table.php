<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts_courses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_id')->unsigned();
            $table->bigInteger('course_id')->unsigned();
            $table->bigInteger('count')->unsigned();
            $table->enum('status', ['success', 'unsuccess'])->default('unsuccess');
            $table->float('percent')->default(0);
            $table->json('random_test')->nullable();
            $table->json('payment')->nullable();
            $table->json('test')->nullable();
            $table->integer('raiting')->nullable();
            $table->string('comment')->nullable();
            $table->tinyInteger('paid')->default(0);
            $table->bigInteger('code')->unsigned();
            $table->integer('page')->default(0);
            $table->tinyInteger('reading')->default(0);
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts_courses');
    }
}
