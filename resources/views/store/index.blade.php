@extends('layouts.admin')

@section('content')

<div class="row mb-4">
    <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body">
                {!! $dataTable->table(['class' => "table table-flush"]) !!}
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/plugins/datatables.js') }}"></script>

    {!! $dataTable->scripts() !!}

@endpush
