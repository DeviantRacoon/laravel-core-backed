<?php

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
        Schema::create('catalog_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
        
        Schema::create('catalog_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        Schema::create('mixed_role_permissions', function (Blueprint $table) {
            // $table->id();
            $table->foreignId('role')->constrained('catalog_roles')->onDelete('cascade');
            $table->foreignId('permission')->constrained('catalog_permissions')->onDelete('cascade');
            $table->primary(['role', 'permission']);
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_roles');
        Schema::dropIfExists('catalog_permissions');
        Schema::dropIfExists('mixed_role_permissions');
    }
};
