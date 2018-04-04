<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMuambasInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muambas_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('detalhes', 255);
            $table->string('local', 90);
            $table->string('situacao', 90);
            $table->unsignedInteger('muambas_id');
            $table->timestamps();
            
            $table->foreign('muambas_id')->references('id')->on('muambas');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('muambas_info');
    }
}