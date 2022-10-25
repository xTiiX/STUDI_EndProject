<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->unsignedBigInteger('access_level')->default(1);
            $table->boolean('is_first_connection')->default(true);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('users')->insert(
            array(
                'email' => env('ADMIN_EMAIL'),
                'password' => Hash::make(env('ADMIN_PASSWORD')),
                'first_name' => 'admin',
                'last_name' => 'admin',
                'access_level' => 0,
                'is_first_connection' => false,
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
