<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->string('slug')->unique();
            $table->string('content')->nullable();
            $table->string('image')->nullable();
            $table->dateTime('publish_date')->nullable();
            $table->enum('status', [1, 2, 3])->default(2)->comments = "Active => 1, Inactive => 2, Archived => 3";
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stories');
    }
};
