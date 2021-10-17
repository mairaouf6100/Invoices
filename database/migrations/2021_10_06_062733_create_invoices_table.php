<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_number',50);//رقم الفاتوره
            $table->date('invoice_Date')->nullable();//تاريخ الفاتوره
            $table->date('Due_date')->nullable();// تاريخ الاستحقاق
            $table->string('product',50);//المنتج
            $table->bigInteger('section_id')->unsigned();//القسم
            $table->foreign('section_id')->references('id')->on('sections')->omDelete('cascade');
            $table->decimal('Amount_collection',8,2)->nullable();
            $table->decimal('Amount_Commission',8,2);
            $table->decimal('Discount',8,2);// الخصم
            $table->decimal('Value_VAT',8,2);//قيمه الضريبه
            $table->string('Rate_VAT',999);// نسبه الضريبه
            $table->decimal('Total',8,2);//الtotal
            $table->string('Status',50);// مدفوعه او غير مدفوغه
            $table->integer('value_Status');//مدفوعه او غير مدفوغه عشان لما اعمل select يبقي بالارقام
            $table->text('note')->nullable();//ملاحظات
            $table->date('payment_Date')->nullable();
            //$table->string('user');//
            $table->softDeletes();//
            $table->timestamps();//created_at/updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
