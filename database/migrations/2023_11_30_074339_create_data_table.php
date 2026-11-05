<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('claim_date')->nullable();
            $table->string('month_rec')->nullable();
            $table->string('year_rec')->nullable();
            $table->string('claim_type')->nullable();
            $table->string('product')->nullable();
            $table->string('source_document')->nullable();
            $table->string('claim_reason')->nullable();
            $table->string('no_claim')->nullable();
            $table->string('no_certificate')->nullable();
            $table->string('status_policy')->nullable();
            $table->string('effective_date')->nullable();
            $table->string('expired_date')->nullable();
            $table->string('partner_distribution_chanel')->nullable();
            $table->string('branch')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('holder_name')->nullable();
            $table->string('insured_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('red_flag')->nullable();
            $table->string('benefit_per_day')->nullable();
            $table->string('benefit_amount')->nullable();
            $table->string('claim_year')->nullable();
            $table->string('age_of_policy')->nullable();
            $table->string('event_date_from')->nullable();
            $table->string('event_date_to')->nullable();
            $table->string('date_of_death')->nullable();
            $table->string('length_of_stay')->nullable();
            $table->string('icu')->nullable();
            $table->string('remaining_days_per_year_diare_dan_typhoid')->nullable();
            $table->string('remaining_days_per_year')->nullable();
            $table->string('exgratia')->nullable();
            $table->string('dokumen_status')->nullable();
            $table->string('doc_receive_date')->nullable();
            $table->string('doc_complete_date')->nullable();
            $table->string('information_complete_date')->nullable();
            $table->string('prev_status')->nullable();
            $table->string('claim_status')->nullable();
            $table->string('reject_status')->nullable();
            $table->bigInteger('claim_amount')->nullable();
            $table->bigInteger('claim_amount_paid')->nullable();
            $table->bigInteger('claim_amount_not_paid')->nullable();
            $table->string('rop')->nullable();
            $table->string('nilai_tunai')->nullable();
            $table->string('hospital_name')->nullable();
            $table->string('doctor_name')->nullable();
            $table->string('doctor_specialization')->nullable();
            $table->string('diagnosis_1')->nullable();
            $table->string('diagnosis_description')->nullable();
            $table->string('diagnosis_2')->nullable();
            $table->string('surgery_name')->nullable();
            $table->string('age_pending')->nullable();
            $table->string('aging_pending')->nullable();
            $table->string('decision_date')->nullable();
            $table->string('month_dec')->nullable();
            $table->string('year_dec')->nullable();
            $table->string('modified_by')->nullable();
            $table->string('claimant_relation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data');
    }
}
