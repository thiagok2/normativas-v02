<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Unidade;

class AddColAdminUnidade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('unidades', function ($table) {
            $table->boolean('admin')->default(false);
        });

        // $unidadeAdmin = Unidade::find(1);
        // if($unidadeAdmin){
        //     $unidadeAdmin->admin = true;
        //     $unidadeAdmin->save();
        // }
        
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
