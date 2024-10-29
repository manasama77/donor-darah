<?php

use App\Models\PoundfitEvent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registrants', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PoundfitEvent::class);
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('city');
            $table->string('phone_emergency');
            $table->string('name_emergency');
            $table->boolean('bring_ripstix')->default(false);
            $table->enum('poundfit_info', [
                'Sosial Media',
                'Radio',
                'Website',
                'Teman / Keluarga',
                'MyBnetfit',
                'Poster',
                'Email',
                'Lain-lain',
            ]);
            $table->string('poundfit_info_etc')->nullable();
            $table->boolean('are_attending')->default(false);
            $table->string('barcode');
            $table->string('eticket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrants');
    }
};
