<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function ( Blueprint $table )
        {
            $table -> id();
            $table -> string( 'resource_id' ) -> unique() -> nullable( false );
            $table -> foreignId( 'status_id' );
            $table -> foreignId( 'priority_id' );
            $table -> foreignId( 'user_id' );

            $table -> string('name');

            $table -> date('start_date');
            $table -> date('due_date');

            $table -> timestamps();

            $table -> foreign('status_id' ) -> on( 'statuses' ) -> references('id' ) -> onDelete( 'cascade' );
            $table -> foreign('priority_id' ) -> on( 'priorities' ) -> references('id' ) -> onDelete( 'cascade' );
            $table -> foreign('user_id' ) -> on( 'users' ) -> references('id' ) -> onDelete( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
