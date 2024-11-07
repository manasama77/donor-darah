<?php

use App\Models\Location;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('donor_darah_events', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Location::class);
            $table->dateTime('event_datetime');
            $table->string('pic_whatsapp');
            $table->boolean('is_published')->default(false);
            $table->integer('registrant_limit')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poundfit_events');
    }
};
