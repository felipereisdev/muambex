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
            $table->dateTime('dh_evento');
            $table->string('ds_local', 255);
            $table->string('ds_status', 90);
            $table->string('ds_encaminhado', 300);
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