@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <div id="reader" width="300px" height="300px"></div>
                        <div class="my-3 text-center">
                            <h4 class="title"> - OR MANUAL SEARCHING - </h4>
                        </div>
                        <input type="text" class="form-control" placeholder="manual input: member code">
                    </div>
                    <div class="col-5">
                        <h2 class="title">{{ $title }}</h2>
                        <div class="customer_result">

                        </div>
                    </div>
                    <div class="col-4">
                        <div class="col-12">
                            <h2 class="title">Store Transactions</h2>
                            <form action="" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Total Transactions</label> <br>
                                    <input type="number" name="total" id="total" class="form-control form-control-lg">
                                </div>
                                <div class="form-group text-end">
                                    <input type="submit" value="Save" class="btn btn-danger btn-block">
                                </div>
                            </form>
                        </div>
                        <div class="col-12">
                            <h2 class="title">History Poin</h2>
                            <div class="alert alert-primary text-white">
                                Customer Get 20 Poin From Total Transaction Rp. 29.000
                            </div>
                            <div class="alert alert-secondary text-white">
                                Customer Get 20 Poin From Total Transaction Rp. 29.000
                            </div>
                            <div class="alert alert-secondary text-white">
                                Customer Get 20 Poin From Total Transaction Rp. 29.000
                            </div>
                            <div class="alert alert-secondary text-white">
                                Customer Get 20 Poin From Total Transaction Rp. 29.000
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
    function onScanSuccess(decodedText, decodedResult) {
  // handle the scanned code as you like, for example:
  console.log(`Code matched = ${decodedText}`, decodedResult);
}

function onScanFailure(error) {

}

let html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  { fps: 10, qrbox: {width: 250, height: 250} },
  /* verbose= */ false
);

$(document).ready(function () {
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
})
</script>
@endpush
