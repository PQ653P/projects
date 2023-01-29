<?php

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConnectServiceAppointment extends Migration
{
    public function up(): void
    {
        Schema::table((new Appointment())->getTable(), function (Blueprint $table){
            $table->foreignIdFor(Service::class);
        });
    }

    public function down(): void
    {
        Schema::dropColumns((new Appointment())->getTable(),['service_id']);
    }
}
