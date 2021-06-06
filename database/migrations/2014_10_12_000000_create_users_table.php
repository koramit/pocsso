<?php

use App\Models\Application;
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

        Schema::create('applications', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name')->unique();
            $table->string('label')->nullable();
            $table->string('url');
            $table->string('token');
            $table->timestamps();
        });

        Schema::create('application_user', function (Blueprint $table) {
            $table->primary(['user_id', 'application_id']);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedSmallInteger('application_id')->constrained('applications')->onDelete('cascade');
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

        $medstock = Application::create([
            'name' => 'medstock',
            'label' => 'Medstock',
            'url' => 'http://pocmapp.test/login', // post => get signed url
            'token' => 'ga8UTtZXEYwRymNWNBkoa7tZ72ERqIuxie8Z7ofcauUxmyW7NKJlIWSXNk5C0qeC',
        ]);

        $edumed = Application::create([
            'name' => 'edumed',
            'label' => 'Medza',
            'url' => 'http://pocmapp.test/login', // post => get signed url
            'token' => 'ga8UTtZXEYwRymNWNBkoa7tZ72ERqIuxie8Z7ofcauUxmyW7NKJlIWSXNk5C0qeC',
        ]);

        $user = User::all();
        $user[0]->applications()->syncWithoutDetaching([$medstock->id, $edumed->id]);
        $user[1]->applications()->syncWithoutDetaching($medstock->id);
        $user[2]->applications()->syncWithoutDetaching($edumed->id);
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
