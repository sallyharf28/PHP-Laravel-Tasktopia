<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use  Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('')->nullable();
            $table->string('firstname')->default('')->nullable();
            $table->string('lastname')->default('')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->tinyInteger('type')->default(1)->comment('1 = admin, 2 = staff');
            $table->text('avatar')->default('no-image-available.png');
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                array(
                    'id' => 1,
                    'name' => 'Administrator',
                    'firstname' => 'Administrator',
                    'lastname' => '',
                    'email' => 'admin@admin.com',
                    'password' => '0192023a7bbd73250516f069df18b500',
                    'type' => 1,
                    'avatar' => 'no-image-available.png',
                    'created_at' => '2020-11-26 10:57:04',
                    'updated_at' => now()
                ),
                array(
                    'id' => 2,
                    'name' => 'John Smith',
                    'firstname' => 'John',
                    'lastname' => 'Smith',
                    'email' => 'jsmith@sample.com',
                    'password' => '1254737c076cf867dc53d60a0364f38e',
                    'type' => 2,
                    'avatar' => '1606978560_avatar.jpg',
                    'created_at' => '2020-12-03 09:26:03',
                    'updated_at' => now()
                ),
                array(
                    'id' => 3,
                    'name' => 'Claire Blake',
                    'firstname' => 'Claire',
                    'lastname' => 'Blake',
                    'email' => 'cblake@sample.com',
                    'password' => '4744ddea876b11dcb1d169fadf494418',
                    'type' => 3,
                    'avatar' => '1606958760_47446233-clean-noir-et-gradient-sombre-image-de-fond-abstrait-.jpg',
                    'created_at' => '2020-12-03 09:26:42',
                    'updated_at' => now()
                ),
                array(
                    'id' => 4,
                    'name' => 'George Wilson',
                    'firstname' => 'George',
                    'lastname' => 'Wilson',
                    'email' => 'gwilson@sample.com',
                    'password' => 'd40242fb23c45206fadee4e2418f274f',
                    'type' => 3,
                    'avatar' => '1606963560_avatar.jpg',
                    'created_at' => '2020-12-03 10:46:41',
                    'updated_at' => now()
                ),
                array(
                    'id' => 5,
                    'name' => 'Mike Williams',
                    'firstname' => 'Mike',
                    'lastname' => 'Williams',
                    'email' => 'mwilliams@sample.com',
                    'password' => '3cc93e9a6741d8b40460457139cf8ced',
                    'type' => 3,
                    'avatar' => '1606963620_47446233-clean-noir-et-gradient-sombre-image-de-fond-abstrait-.jpg',
                    'created_at' => '2020-12-03 10:47:06',
                    'updated_at' => now()
                )
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
