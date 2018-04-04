<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMuambasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muambas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 90);
            $table->string('codigo_rastreio', 30);
            $table->tinyInteger('fl_recebido')->default(0);
            $table->unsignedInteger('user_id');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('muambas');
    }
}