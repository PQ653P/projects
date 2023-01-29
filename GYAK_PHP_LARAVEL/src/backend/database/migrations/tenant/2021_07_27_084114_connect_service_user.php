<?php

use App\Models\Post;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConnectServiceUser extends Migration
{
    public function up(): void
    {
        Schema::table((new Service())->getTable(), function (Blueprint $table){
            $table->foreignIdFor(User::class);
        });
    }

    public function down(): void
    {
        Schema::dropColumns((new Service())->getTable(), ['user_id']);
    }
}
