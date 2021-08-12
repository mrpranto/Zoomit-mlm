<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id');
//            $table->foreignId('sender_user_id')->constrained('users', 'id');
//            $table->foreignId('receiver_user_id')->constrained('users', 'id');
            $table->foreignId('payment_type_id')->nullable()->constrained();
            $table->decimal('amount',12,2);
            $table->enum('type', ['income', 'withdraw', 'registration_fee']);
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
        Schema::dropIfExists('wallets');
    }
}
