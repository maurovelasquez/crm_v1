<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('type_document', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('format_dcr', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date_done');
            $table->string('dcr');
            $table->string('resolved');
        });
        Schema::create('rec_cctv', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('type_maintenance_damage', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('regional', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('item_theft', function (Blueprint $table) {
            $table->id();
            $table->string('results');
            $table->string('type_result');
        });
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string('name_user');
            $table->string('lastname');
            $table->string('document_id');
            $table->string('user');
            $table->string('password');
            $table->foreignid('idrole')->references('id')->on ('role');
            $table->foreignid('idtype_document')->references('id')->on ('type_document');
        });
        Schema::create('evaluation_collaborator_investigation', function (Blueprint $table) {
            $table->id();
            $table->string('dcr');
            $table->string('give_on_time');
            $table->string('compliance_percentage');
            $table->string('evaluator');
            $table->foreignid('idusuario')->references('id')->on ('usuario');
        });
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignid('idregional')->references('id')->on ('regional');
        });
        Schema::create('evaluation_collaborator_security', function (Blueprint $table) {
            $table->id();
            $table->string('compliance_percentage');
            $table->foreignid('idusuario')->references('id')->on ('usuario');
        });
        Schema::create('branch_offices', function (Blueprint $table) {
            $table->id();
            $table->string('cost_center');
            $table->string('name');
            $table->string('type_attention');
            $table->string('admin');
            $table->string('email');
            $table->string('telephoner');
            $table->string('direction');
            $table->foreignid('idcities')->references('id')->on ('cities');
            $table->foreignid('idregional')->references('id')->on ('regional');
        });
        Schema::create('request_videos', function (Blueprint $table) {
            $table->id();
            $table->date('date_request');
            $table->date('start_date');
            $table->date('final_date');
            $table->string('number_cam');
            $table->string('name_cam');
            $table->foreignid('idcities')->references('id')->on ('cities');
            $table->foreignid('idbranch_offices')->references('id')->on ('branch_offices');
        });
        Schema::create('request_novelties', function (Blueprint $table) {
            $table->id();
            $table->string('type_request');
            $table->date('date');
            $table->string('observations');
            $table->foreignid('idcities')->references('id')->on ('cities');
            $table->foreignid('idbranch_offices')->references('id')->on ('branch_offices');
        });
        Schema::create('safes_box', function (Blueprint $table) {
            $table->id();
            $table->string('state');
            $table->string('password');
            $table->foreignid('idcities')->references('id')->on ('cities');
            $table->foreignid('idbranch_offices')->references('id')->on ('branch_offices');
        });
        Schema::create('electronic_security', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('alarm');
            $table->string('fault_alarm');
            $table->string('quantity');
            $table->string('antenna_failure');
            $table->date('date_test_failure');
            $table->string('ticket_failure');
            $table->string('button_cover');
            $table->string('numbers_button');
            $table->string('fault_button');
            $table->date('date_test_button');
            $table->string('ticket_button');
            $table->string('connection_cam');
            $table->string('numbers_cam');
            $table->string('observations');
            $table->string('type_cam');
            $table->foreignid('idcities')->references('id')->on ('cities');
            $table->foreignid('idbranch_offices')->references('id')->on ('branch_offices');
            $table->foreignid('idrec_cctv')->references('id')->on ('rec_cctv');
        });
        Schema::create('repair_news', function (Blueprint $table) {
            $table->id();
            $table->string('ticket');
            $table->string('state');
            $table->string('managers');
            $table->foreignid('idtype_maintenance_damage')->references('id')->on ('type_maintenance_damage');
            $table->foreignid('idbranch_offices')->references('id')->on ('branch_offices');
        });
        Schema::create('request_response', function (Blueprint $table) {
            $table->id();
            $table->date('answer_date');
            $table->string('response');
            $table->foreignid('idcities')->references('id')->on ('cities');
            $table->foreignid('idbranch_offices')->references('id')->on ('branch_offices');
        });
        Schema::create('report_thefts', function (Blueprint $table) {
            $table->id();
            $table->string('month');
            $table->string('ticket');
            $table->date('date_ticket');
            $table->string('managers');
            $table->string('detail');
            $table->foreignid('idcities')->references('id')->on ('cities');
            $table->foreignid('idbranch_offices')->references('id')->on ('branch_offices');
            $table->foreignid('idregional')->references('id')->on ('regional');
            $table->foreignid('iditem_theft')->references('id')->on ('item_theft');
        });
        Schema::create('research_leader_report', function (Blueprint $table) {
            $table->id();
            $table->string('dcr');
            $table->string('month');
            $table->date('date_received');
            $table->date('date_close');
            $table->string('day');
            $table->string('state');
            $table->string('investigated');
            $table->string('observations');
            $table->string('remitter');
            $table->string('with_minor_sanction');
            $table->string('numers_minor_sanction');
            $table->string('direct_fired');
            $table->string('contractors_laid_off');
            $table->string('results');
            $table->string('assigned_to');
            $table->string('criminal_process');
            $table->foreignid('idbranch_offices')->references('id')->on ('branch_offices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crm_tools');
    }
}
