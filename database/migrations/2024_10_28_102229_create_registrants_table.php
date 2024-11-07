<?php

use App\Models\DonorDarahEvent;
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
            $table->foreignIdFor(DonorDarahEvent::class);
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->date('dob');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('city');
            $table->string('phone_emergency');
            $table->string('name_emergency');
            $table->enum('golongan_darah', ['a', 'b', 'ab', 'o']);
            $table->enum('rhesus', ['positive', 'negative', 'unknown']);
            $table->integer('weight');
            $table->boolean('previous_donation')->default(false);
            $table->enum('donor_darah_info', [
                'Sosial Media',
                'Radio',
                'Website',
                'Teman / Keluarga',
                'MyBnetfit',
                'Poster',
                'Email',
                'Lain-lain',
            ]);
            $table->string('donor_darah_info_etc')->nullable();
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
