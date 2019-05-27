<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateStatusExtratorDocumentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::select("UPDATE documentos SET status_extrator = 'NA' WHERE tipo_entrada != 'extrator'");

        DB::select("ALTER TABLE documentos ALTER COLUMN status_extrator SET DEFAULT 'NA'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
