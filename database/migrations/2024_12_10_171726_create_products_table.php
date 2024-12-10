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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50);
            $table->string('name', 80);
            $table->integer('stcok')->unsigned()->default(0);
            $table->string('description', 255);
            $table->date('expiration_date')->nullable();
            $table->string('img_path', 255)->nullable();
            $table->tinyInteger("status")->default(1);
            $table->foreignId(column: 'brand_id')->constrained('brands')->onDelete('cascade');
            $table->foreignId(column: 'presentation_id')->constrained('presentations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
