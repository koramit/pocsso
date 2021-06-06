<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateUsersTable extends Migration
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
            $table->string('name')->unique();
            $table->string('login')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $now = now();
        User::insert([
            [
                'name' => 'admin',
                'login' => 'somchai.adm',
                'password' => Hash::make(Str::random(12)),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'medstock',
                'login' => 'somying.med',
                'password' => Hash::make(Str::random(12)),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'edumed',
                'login' => 'sombhon.edu',
                'password' => Hash::make(Str::random(12)),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
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
}
