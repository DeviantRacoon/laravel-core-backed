<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catalog_persons', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('middleName')->nullable();
            $table->string('lastName');
            $table->string('secondName');
            $table->string('gender');
            $table->date('birthDate')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        Schema::create('catalog_person_address', function (Blueprint $table) {
            $table->id();
            $table->string('street');
            $table->string('exteriorNumber');
            $table->string('interiorNumber')->nullable();
            $table->string('neighborhood');
            $table->string('address_reference')->nullable();
            $table->string('municipality');
            $table->string('state');
            $table->string('country');
            $table->string('postalCode');
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        Schema::create('catalog_person_additional_data', function (Blueprint $table) {
            $table->id();
            $table->string('curp');
            $table->string('cellphone');
            $table->foreignId('address_id')->constrained('catalog_person_address')->onDelete('cascade');
            $table->string('photo')->nullable();
            $table->foreignId('person_id')->constrained('catalog_persons')->onDelete('cascade');
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        Schema::table('catalog_users', function (Blueprint $table) {
            $table->foreignId('person_id')->nullable()->constrained('catalog_persons')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('catalog_users', function (Blueprint $table) {
            $table->dropForeign(['person_id']);
            $table->dropColumn('person_id');
        });

        Schema::dropIfExists('catalog_person_additional_data');
        Schema::dropIfExists('catalog_person_address');
        Schema::dropIfExists('catalog_persons');
    }
};

