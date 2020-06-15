<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_transactions', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_return')->default(1)->comment('0 mean this is return transaction');
            $table->double('amount')->default(0);
            $table->enum('payment_method',['Cash', 'Card', 'Cheque', 'Bank Transfer', 'Other',  'Supplier Account', 'Custom Payment'])->default('Cash');
            $table->string('card_number',100)->nullable();
            $table->string('card_holder_name',100)->nullable();
            $table->string('card_transaction_no',100)->nullable();
            $table->enum('card_type',['Credit Card', 'Debit Card', 'Visa Card', 'Master Card'])->nullable();
            $table->enum('card_month',['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'])->nullable();
            $table->smallInteger('card_year')->nullable();
            $table->smallInteger('csv')->nullable();
            $table->string('cheque_number',100)->nullable();
            $table->string('bank_account_no',100)->nullable()->comment('This is for Bank Transfer payment method');
            $table->string('transaction_no',100)->nullable()->comment('This is for Custom Payment payment method');
            $table->string('description')->nullable();
            $table->foreignId('warehouses_id')->nullable()->constrained()->onDelete('SET NULL')->onUpdate('No Action');
            $table->foreignId('account_books_id')->nullable()->constrained()->onDelete('SET NULL')->onUpdate('No Action');
            $table->foreignId('suppliers_id')->nullable()->constrained()->onDelete('SET NULL')->onUpdate('No Action');
            $table->foreignId('purchase_invoices_id')->constrained()->onDelete('cascade')->onUpdate('No Action');
            $table->foreignId('business_id')->constrained()->onDelete('cascade')->onUpdate('No Action');
            $table->foreignId('users_id')->nullable()->constrained()->onDelete('SET NULL')->onUpdate('No Action');
            $table->softDeletes();
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
        Schema::dropIfExists('purchase_transactions');
    }
}
