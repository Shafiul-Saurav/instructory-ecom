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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pcategory_id')->constrained('post_categories')->onDelete('cascade');
            $table->foreignId('subcategory_id')->constrained('post_subcategories')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('post_name');
            $table->string('post_slug');
            $table->longText('post_description');
            $table->longText('long_description');
            $table->string('post_image')->default('default_post.jpg');
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_active')->default(false);
            $table->string('admin_comment')->nullable();
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
        Schema::dropIfExists('posts');
    }
};
