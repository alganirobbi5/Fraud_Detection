@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Table</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Data Table</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            {{-- notifikasi form validasi --}}
            @if ($errors->has('file'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{ $errors->first('file') }}</strong>
            </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex flex-wrap align-items-center">
                            <button type="button" class="btn btn-primary mr-2 mb-2 mb-sm-0" data-toggle="modal" data-target="#importExcel">
                                <i class="fa-solid fa-file-import"></i> IMPORT EXCEL
                            </button>
                            <button type="button" class="btn btn-danger mb-2 mb-sm-0" data-toggle="modal" data-target="#delete_data">
                                <i class="fa-regular fa-trash-can"></i> DELETE DATA
                            </button>
                            <span class="text-muted small ml-sm-auto mt-2 mt-sm-0">
                                Geser horizontal untuk melihat seluruh kolom
                            </span>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive table-sticky data-table-scroll">
                                <table class="table table-bordered table-hover table-sm data-table text-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th width="10px">#</th>
                                            <th>Claim Date</th>
                                            <th>Month (Rec)</th>
                                            <th>Year (Rec)</th>
                                            <th>Claim Type</th>
                                            <th>Product</th>
                                            <th>Source Document</th>
                                            <th>Claim Reason</th>
                                            <th>No. Claim</th>
                                            <th>No. Certificate</th>
                                            <th>Status Policy</th>
                                            <th>Effective Date</th>
                                            <th>Expired Date</th>
                                            <th>Partner Distribution Channel</th>
                                            <th>Branch</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Province</th>
                                            <th>Holder Name</th>
                                            <th>Insured Name</th>
                                            <th>Gender</th>
                                            <th>Age</th>
                                            <th>Red Flag</th>
                                            <th>Benefit/Day</th>
                                            <th>Benefit Amount</th>
                                            <th>Claim Year</th>
                                            <th>Age of Policy</th>
                                            <th>Event Date From</th>
                                            <th>Even Date To</th>
                                            <th>Date Of Death</th>
                                            <th>Length Of Stay</th>
                                            <th>ICU</th>
                                            <th>Remaining Days/Year (Diare & Typhoid)</th>
                                            <th>Remaining Days/Year</th>
                                            <th>Exgratia</th>
                                            <th>Document Status</th>
                                            <th>Doc.Receive Date</th>
                                            <th>Doc.Complete Date</th>
                                            <th>Information Complete Date</th>
                                            <th>Prev.Status</th>
                                            <th>Claim Status</th>
                                            <th>Reject Status</th>
                                            <th>Claim Amount</th>
                                            <th>Claim Amount Paid</th>
                                            <th>Claim Amount Not Paid</th>
                                            <th>ROP</th>
                                            <th>Nilai Tunai</th>
                                            <th>Hospital Name</th>
                                            <th>Doctor Name</th>
                                            <th>Doctor Specialization</th>
                                            <th>Diagnosis 1</th>
                                            <th>Diagnosis Description</th>
                                            <th>Diagnosis 2</th>
                                            <th>Surgery Name</th>
                                            <th>Age Pending</th>
                                            <th>Aging Pending</th>
                                            <th>Decision Date</th>
                                            <th>Month (Dec)</th>
                                            <th>Year (Dec)</th>
                                            <th>Modified By</th>
                                            <th>Claimant Relation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1 @endphp
                                        @foreach($data as $row)
                                        <tr>
                                            <td>{{ $i++}}</td>
                                            <td>{{ $row->claim_date}}</td>
                                            <td>{{ $row->month_rec}}</td>
                                            <td>{{ $row->year_rec}}</td>
                                            <td>{{ $row->claim_type}}</td>
                                            <td>{{ $row->product}}</td>
                                            <td>{{ $row->source_document}}</td>
                                            <td>{{ $row->claim_reason}}</td>
                                            <td>{{ $row->no_claim}}</td>
                                            <td>{{ $row->no_certificate}}</td>
                                            <td>{{ $row->status_policy}}</td>
                                            <td>{{ $row->effective_date}}</td>
                                            <td>{{ $row->expired_date}}</td>
                                            <td>{{ $row->partner_distribution_chanel}}</td>
                                            <td>{{ $row->branch}}</td>
                                            <td>{{ $row->address}}</td>
                                            <td>{{ $row->city}}</td>
                                            <td>{{ $row->province}}</td>
                                            <td>{{ $row->holder_name}}</td>
                                            <td>{{ $row->insured_name}}</td>
                                            <td>{{ $row->gender}}</td>
                                            <td>{{ $row->age}}</td>
                                            <td>{{ $row->red_flag}}</td>
                                            <td>Rp{{number_format($row->benefit_per_day,0,',','.')}}</td>
                                            <td>Rp{{number_format($row->benefit_amount,0,',','.')}}</td>
                                            <td>{{ $row->claim_year}}</td>
                                            <td>{{ $row->age_of_policy}}</td>
                                            <td>{{ $row->event_date_from}}</td>
                                            <td>{{ $row->event_date_to}}</td>
                                            <td>{{ $row->date_of_death}}</td>
                                            <td>{{ $row->length_of_stay}}</td>
                                            <td>{{ $row->icu}}</td>
                                            <td>{{ $row->remaining_days_per_year_diare_dan_typhoid}}</td>
                                            <td>{{ $row->remaining_days_per_year}}</td>
                                            <td>{{ $row->exgratia}}</td>
                                            <td>{{ $row->dokumen_status}}</td>
                                            <td>{{ $row->doc_receive_date}}</td>
                                            <td>{{ $row->doc_complete_date}}</td>
                                            <td>{{ $row->information_complete_date}}</td>
                                            <td>{{ $row->prev_status}}</td>
                                            <td>{{ $row->claim_status}}</td>
                                            <td>{{ $row->reject_status}}</td>
                                            <td>Rp{{number_format ($row->claim_amount,0,',','.')}}</td>
                                            <td>Rp{{number_format ($row->claim_amount_paid,0,',','.')}}</td>
                                            <td>Rp{{number_format ($row->claim_amount_not_paid,0,',','.')}}</td>
                                            <td>{{ $row->rop}}</td>
                                            <td>{{ $row->nilai_tunai}}</td>
                                            <td>{{ $row->hospital_name}}</td>
                                            <td>{{ $row->doctor_name}}</td>
                                            <td>{{ $row->doctor_specialization}}</td>
                                            <td>{{ $row->diagnosis_1}}</td>
                                            <td>{{ $row->diagnosis_description}}</td>
                                            <td>{{ $row->diagnosis_2}}</td>
                                            <td>{{ $row->surgery_name}}</td>
                                            <td>{{ $row->age_pending}}</td>
                                            <td>{{ $row->aging_pending}}</td>
                                            <td>{{ $row->decision_date}}</td>
                                            <td>{{ $row->month_dec}}</td>
                                            <td>{{ $row->year_dec}}</td>
                                            <td>{{ $row->modified_by}}</td>
                                            <td>{{ $row->claimant_relation}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Import Excel -->
            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="post" action="/data/import_data" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{ csrf_field() }}

                                <label>Select the excel file</label>
                                <div class="form-group">
                                    <input type="file" name="file" required="required">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-file-import"></i> Import</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Data -->
            <form method="POST" action='/data/delete_data'>
                <div class="modal fade" id="delete_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Caution !</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this data?</p>

                                @csrf
                                {{ method_field('DELETE') }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Close</button>
                                <button type="submit" class="btn btn-danger"><i class="fa-regular fa-trash-can"></i> Yes, Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
