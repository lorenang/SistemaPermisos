<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesJurisdiccionalesTiposMediacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_jurisdiccionales_tiposMediacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('jurisdiccion_id');
            $table->unsignedBigInteger('tipoMediacion_id');

            // Definir las claves foráneas
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            
            $table->string('usuario', 30)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_jurisdiccionales_tiposMediacion');
    }
}
