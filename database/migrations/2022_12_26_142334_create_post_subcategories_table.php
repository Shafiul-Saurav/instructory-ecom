<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_subcategories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pcategory_id')->constrained('post_categories')->onDelete('cascade');
            $table->string('subcategory_name');
            $table->string('subcategory_slug');
            $table->string('subcategory_image')->nullable()->default('default_subcategory.jpg');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_subcategories');
    }
};
