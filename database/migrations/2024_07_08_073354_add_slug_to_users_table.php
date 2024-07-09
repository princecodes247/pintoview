<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('slug')->unique()->nullable()->after('name');
        });

        User::all()->each(function ($user) {
            $slug = Str::slug($user->name);
            $counter = 1;
            while (User::where('slug', $slug)->where('id', '!=', $user->id)->exists()) {
                $slug = Str::slug($user->name) . '-' . $counter;
                $counter++;
            }
            $user->update(['slug' => $slug]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('slug');
        });
    }
};
