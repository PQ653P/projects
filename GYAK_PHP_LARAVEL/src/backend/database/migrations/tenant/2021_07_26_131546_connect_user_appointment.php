<?php

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConnectUserAppointment extends Migration
{
    public function up(): void
    {
        Schema::table((new Appointment())->getTable(), function (Blueprint $table){
            $table->foreignIdFor(User::class);
        });
}

    public function down(): void
    {
        Schema::dropColumns((new Appointment())->getTable(),['user_id']);
    }
}
