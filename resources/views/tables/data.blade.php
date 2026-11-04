@extends('layouts.admin')

@section('content')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endpush

@php
    $money = function ($value) {
        return $value === null || $value === '' ? '—' : 'Rp' . number_format($value, 0, ',', '.');
    };
@endphp

<div class="content-wrapper dashboard-page tables-page">
    <div class="dash-shell">
        <header class="dash-header">
            <div class="dash-header-main">
                <p class="dash-eyebrow">Data Operasional</p>
                <h1 class="dash-title">Data Klaim</h1>
                <p class="dash-subtitle">Kelola data klaim yang menjadi dasar perhitungan skor risiko.</p>
            </div>
            <div class="dash-header-actions">
                <span class="dash-updated"><i class="fas fa-database"></i>{{ $data->count() }} baris</span>
                <button type="button" class="dash-btn dash-btn-primary" data-toggle="modal" data-target="#importExcel">
                    <i class="fas fa-file-import"></i> Import Excel
                </button>
                @if(!$data->isEmpty())
                <button type="button" class="dash-btn tbl-btn-danger" data-toggle="modal" data-target="#delete_data">
                    <i class="fas fa-trash-can"></i> Hapus Data
                </button>
                @endif
            </div>
        </header>

        @if ($errors->has('file'))
        <div class="tbl-alert tbl-alert-danger" role="alert">
            <i class="fas fa-circle-exclamation"></i>
            <div>
                <strong>Import gagal.</strong> {{ $errors->first('file') }}
            </div>
            <button type="button" class="tbl-alert-close" data-dismiss="alert" aria-label="Tutup">&times;</button>
        </div>
        @endif

        <section class="dash-card">
            <div class="dash-card-head">
                <div>
                    <h2 class="dash-card-title">Seluruh Data Klaim</h2>
                    <p class="dash-card-sub">61 kolom data &bull; geser horizontal untuk melihat seluruh detail</p>
                </div>
                <span class="tbl-count">{{ $data->count() }} baris</span>
            </div>

            @if($data->isEmpty())
            <div class="dash-card-body">
                <div class="dash-empty">
                    <span class="dash-empty-icon"><i class="fas fa-table"></i></span>
                    <h2>Belum ada data klaim</h2>
                    <p>Import file Excel untuk mulai mengisi tabel dan menghitung skor risiko.</p>
                    <button type="button" class="dash-btn dash-btn-primary" data-toggle="modal" data-target="#importExcel">
                        <i class="fas fa-file-import"></i> Import Excel
                    </button>
                </div>
            </div>
            @else
            <div class="tbl-table-scroll">
                <table class="dash-table tbl-data-table">
                    <thead>
                        <tr>
                            <th class="tbl-rownum">#</th>
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
                            <th>Event Date To</th>
                            <th>Date Of Death</th>
                            <th>Length Of Stay</th>
                            <th>ICU</th>
                            <th>Remaining Days/Year (Diare &amp; Typhoid)</th>
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
                        @foreach($data as $row)
                        <tr>
                            <td class="tbl-rownum">{{ $loop->iteration }}</td>
                            <td>{{ $row->claim_date ?? '—' }}</td>
                            <td>{{ $row->month_rec ?? '—' }}</td>
                            <td class="is-numeric">{{ $row->year_rec ?? '—' }}</td>
                            <td>{{ $row->claim_type ?? '—' }}</td>
                            <td>{{ $row->product ?? '—' }}</td>
                            <td>{{ $row->source_document ?? '—' }}</td>
                            <td>{{ $row->claim_reason ?? '—' }}</td>
                            <td class="tbl-mono">{{ $row->no_claim ?? '—' }}</td>
                            <td class="tbl-mono">{{ $row->no_certificate ?? '—' }}</td>
                            <td>{{ $row->status_policy ?? '—' }}</td>
                            <td>{{ $row->effective_date ?? '—' }}</td>
                            <td>{{ $row->expired_date ?? '—' }}</td>
                            <td>{{ $row->partner_distribution_chanel ?? '—' }}</td>
                            <td>{{ $row->branch ?? '—' }}</td>
                            <td>{{ $row->address ?? '—' }}</td>
                            <td>{{ $row->city ?? '—' }}</td>
                            <td>{{ $row->province ?? '—' }}</td>
                            <td>{{ $row->holder_name ?? '—' }}</td>
                            <td>{{ $row->insured_name ?? '—' }}</td>
                            <td>{{ $row->gender ?? '—' }}</td>
                            <td class="is-numeric">{{ $row->age ?? '—' }}</td>
                            <td>{{ $row->red_flag ?? '—' }}</td>
                            <td class="is-numeric tbl-amount">{{ $money($row->benefit_per_day) }}</td>
                            <td class="is-numeric tbl-amount">{{ $money($row->benefit_amount) }}</td>
                            <td class="is-numeric">{{ $row->claim_year ?? '—' }}</td>
                            <td class="is-numeric">{{ $row->age_of_policy ?? '—' }}</td>
                            <td>{{ $row->event_date_from ?? '—' }}</td>
                            <td>{{ $row->event_date_to ?? '—' }}</td>
                            <td>{{ $row->date_of_death ?? '—' }}</td>
                            <td class="is-numeric">{{ $row->length_of_stay ?? '—' }}</td>
                            <td class="is-numeric">{{ $row->icu ?? '—' }}</td>
                            <td class="is-numeric">{{ $row->remaining_days_per_year_diare_dan_typhoid ?? '—' }}</td>
                            <td class="is-numeric">{{ $row->remaining_days_per_year ?? '—' }}</td>
                            <td>{{ $row->exgratia ?? '—' }}</td>
                            <td>{{ $row->dokumen_status ?? '—' }}</td>
                            <td>{{ $row->doc_receive_date ?? '—' }}</td>
                            <td>{{ $row->doc_complete_date ?? '—' }}</td>
                            <td>{{ $row->information_complete_date ?? '—' }}</td>
                            <td>{{ $row->prev_status ?? '—' }}</td>
                            <td>{{ $row->claim_status ?? '—' }}</td>
                            <td>{{ $row->reject_status ?? '—' }}</td>
                            <td class="is-numeric tbl-amount">{{ $money($row->claim_amount) }}</td>
                            <td class="is-numeric tbl-amount">{{ $money($row->claim_amount_paid) }}</td>
                            <td class="is-numeric tbl-amount">{{ $money($row->claim_amount_not_paid) }}</td>
                            <td class="is-numeric">{{ $row->rop ?? '—' }}</td>
                            <td class="is-numeric">{{ $row->nilai_tunai ?? '—' }}</td>
                            <td>{{ $row->hospital_name ?? '—' }}</td>
                            <td>{{ $row->doctor_name ?? '—' }}</td>
                            <td>{{ $row->doctor_specialization ?? '—' }}</td>
                            <td>{{ $row->diagnosis_1 ?? '—' }}</td>
                            <td>{{ $row->diagnosis_description ?? '—' }}</td>
                            <td>{{ $row->diagnosis_2 ?? '—' }}</td>
                            <td>{{ $row->surgery_name ?? '—' }}</td>
                            <td class="is-numeric">{{ $row->age_pending ?? '—' }}</td>
                            <td class="is-numeric">{{ $row->aging_pending ?? '—' }}</td>
                            <td>{{ $row->decision_date ?? '—' }}</td>
                            <td class="is-numeric">{{ $row->month_dec ?? '—' }}</td>
                            <td class="is-numeric">{{ $row->year_dec ?? '—' }}</td>
                            <td>{{ $row->modified_by ?? '—' }}</td>
                            <td>{{ $row->claimant_relation ?? '—' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </section>
    </div>

    <div class="modal fade tbl-modal" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="importExcelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="post" action="/data/import_data" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="tbl-modal-header">
                        <div>
                            <h5 class="tbl-modal-title" id="importExcelLabel">Import Excel</h5>
                            <p class="tbl-modal-sub">Format yang didukung: .xlsx, .xls, .csv</p>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="tbl-modal-body">
                        {{ csrf_field() }}

                        <label class="tbl-field-label" for="file-import">Pilih file data klaim</label>
                        <input type="file" id="file-import" name="file" class="tbl-file-input" required="required">
                        <p class="tbl-modal-note">Pastikan urutan kolom sesuai template agar data terbaca dengan benar.</p>
                    </div>
                    <div class="tbl-modal-footer">
                        <button type="button" class="dash-btn" data-dismiss="modal">Batal</button>
                        <button type="submit" class="dash-btn dash-btn-primary">
                            <i class="fas fa-file-import"></i> Import
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(!$data->isEmpty())
    <form method="POST" action="/data/delete_data">
        @csrf
        @method('DELETE')
        <div class="modal fade tbl-modal" id="delete_data" tabindex="-1" role="dialog" aria-labelledby="deleteDataLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="tbl-modal-header tbl-modal-header-danger">
                        <div>
                            <h5 class="tbl-modal-title" id="deleteDataLabel">Hapus semua data?</h5>
                            <p class="tbl-modal-sub">Tindakan ini tidak dapat dibatalkan.</p>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="tbl-modal-body">
                        <p>Seluruh baris pada tabel <strong>data</strong> dan file import di folder <code>file_data</code> akan dihapus.</p>
                    </div>
                    <div class="tbl-modal-footer">
                        <button type="button" class="dash-btn" data-dismiss="modal">Batal</button>
                        <button type="submit" class="dash-btn tbl-btn-danger">
                            <i class="fas fa-trash-can"></i> Ya, hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endif
</div>
@endsection
