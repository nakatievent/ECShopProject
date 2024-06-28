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
        Schema::create('products', function (Blueprint $table) {
            $table->id()->comment('ID');

            // 外部キー
            $table->unsignedInteger('brand_id')->comment('ブランドID');

            // 商品情報
            $table->string('name')->comment('商品名');
            $table->text('description')->nullable()->comment('商品説明');
            $table->text('detail')->nullable()->comment('商品詳細');
            $table->unsignedInteger('price')->comment('価格');
            $table->unsignedInteger('stock')->comment('在庫数量');
            $table->string('sku')->unique()->comment('商品管理コード');
            $table->string('image_url')->nullable()->comment('商品画像URL');
            $table->string('image_alt')->nullable()->comment('alt属性の説明');
            $table->string('size')->nullable()->comment('サイズ');
            $table->boolean('status')->default(true)->comment('商品ステータス');
            $table->decimal('discount', 5, 2)->nullable()->comment('割引率');
            $table->unsignedInteger('reviews_count')->default(0)->comment('レビュー数');

            // 日付情報
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // リレーションにproduct_idが入っていると外部キー制約で削除できないので下記の記述で削除
        Schema::dropIfExists('product_color_relations');
        Schema::dropIfExists('product_size_relations');
        Schema::dropIfExists('product_image_relations');
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('products');
    }
};
