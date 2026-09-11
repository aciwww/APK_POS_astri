<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('penjualan', function (Blueprint $table) { // DIPERBAIKI: nama tabel penjualan (tunggal), bukan penjualans
        $table->decimal('uang_dibayar', 15, 2)->default(0)->after('total_pembayaran'); // DIPERBAIKI: kolom "total" tidak ada, yang ada total_pembayaran
        $table->decimal('kembalian', 15, 2)->default(0)->after('uang_dibayar');
    });
}

public function down()
{
    Schema::table('penjualan', function (Blueprint $table) { // DIPERBAIKI
        $table->dropColumn(['uang_dibayar', 'kembalian']);
    });
}
};