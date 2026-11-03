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
            $table->string('claim_date');
            $table->string('month_rec');
            $table->string('year_rec');
            $table->string('claim_type');
            $table->string('product');
            $table->string('source_document');
            $table->string('claim_reason');
            $table->string('no_claim');
            $table->string('no_certificate');
            $table->string('status_policy');
            $table->string('effective_date');
            $table->string('expired_date');
            $table->string('partner_distribution_chanel');
            $table->string('branch');
            $table->string('address');
            $table->string('city');
            $table->string('province');
            $table->string('holder_name');
            $table->string('insured_name');
            $table->string('gender');
            $table->string('age');
            $table->string('red_flag');
            $table->string('benefit_per_day');
            $table->string('benefit_amount');
            $table->string('claim_year');
            $table->string('age_of_policy');
            $table->string('event_date_from');
            $table->string('event_date_to');
            $table->string('date_of_death');
            $table->string('length_of_stay');
            $table->string('icu');
            $table->string('remaining_days_per_year_diare_dan_typhoid');
            $table->string('remaining_days_per_year');
            $table->string('exgratia');
            $table->string('dokumen_status');
            $table->string('doc_receive_date');
            $table->string('doc_complete_date');
            $table->string('information_complete_date');
            $table->string('prev_status');
            $table->string('claim_status');
            $table->string('reject_status');
            $table->bigInteger('claim_amount');
            $table->bigInteger('claim_amount_paid');
            $table->bigInteger('claim_amount_not_paid');
            $table->string('rop');
            $table->string('nilai_tunai');
            $table->string('hospital_name');
            $table->string('doctor_name');
            $table->string('doctor_specialization');
            $table->string('diagnosis_1');
            $table->string('diagnosis_description');
            $table->string('diagnosis_2');
            $table->string('surgery_name');
            $table->string('age_pending');
            $table->string('aging_pending');
            $table->string('decision_date');
            $table->string('month_dec');
            $table->string('year_dec');
            $table->string('modified_by');
            $table->string('claimant_relation');
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
