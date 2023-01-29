<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConnectPostUser extends Migration
{
    public function up(): void
    {
        Schema::table((new Post())->getTable(), function (Blueprint $table){
            $table->foreignIdFor(User::class);
        });
    }

    public function down(): void
    {
        Schema::dropColumns((new Post())->getTable(), ['user_id']);
    }
}
