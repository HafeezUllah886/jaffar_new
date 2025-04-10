@extends('layout.popups')
@section('content')
        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="card" id="demo">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-header border-bottom-dashed p-4">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h1>{{projectName()}}</h1>
                                    </div>
                                    <div class="flex-shrink-0 mt-sm-0 mt-3">
                                        <h3>Sales GST Report</h3>
                                    </div>
                                </div>
                            </div>
                            <!--end card-header-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">From</p>
                                        <h5 class="fs-14 mb-0">{{ date('d M Y', strtotime($from)) }}</h5>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">To</p>
                                        <h5 class="fs-14 mb-0">{{ date('d M Y', strtotime($to)) }}</h5>
                                    </div>
                                    <!--end col-->
                                    <!--end col-->
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Printed On</p>
                                        <h5 class="fs-14 mb-0"><span id="total-amount">{{ date("d M Y") }}</span></h5>
                                        {{-- <h5 class="fs-14 mb-0"><span id="total-amount">{{ \Carbon\Carbon::now()->format('h:i A') }}</span></h5> --}}
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr class="table-active">
                                                <th scope="col" style="width: 50px;">Inv #</th>
                                                <th scope="col" class="text-start">Customer Name</th>
                                                <th scope="col">CNIC #</th>
                                                <th scope="col">NTN #</th>
                                                <th scope="col">STRN #</th>
                                                <th scope="col">Bill Date</th>
                                                <th scope="col">Tax Exc</th>
                                                <th scope="col">Bill Amount (RP)</th>
                                                <th scope="col" class="text-end">GST (18%)</th>
                                                <th scope="col" class="text-end">Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @php
                                                $totalTi = 0;
                                                $totalGst = 0;
                                                $totalQty = 0;
                                                $totalTe = 0;
                                                $totalBA = 0;
                                            @endphp
                                        @foreach ($sales as $key => $item)
                                        @php
                                        $ti = $item->details->sum('ti');
                                        $gst = $item->details->sum('gstValue');
                                        $qty = $item->details->sum('qty');
                                        $bonus = $item->details->sum('bonus');
                                        $ba = $item->totalBill;
                                        $te = $ti - $gst;
                                        $totalTi += $ti;

                                        $totalQty += ($qty + $bonus);
                                        $totalTe += $te;
                                        $totalBA += $ba;
                                        $totalGst += $gst;
                                        @endphp
                                            <tr>
                                                <td>{{ $item->id}}</td>
                                                <td class="text-start">{{ $item->customer->title }}</td>
                                                <td >{{ $item->customer->cnic ?? "-" }}</td>
                                                <td >{{ $item->customer->ntn ?? "-" }}</td>
                                                <td >{{ $item->customer->strn ?? "-" }}</td>
                                                <td>{{ date("d M Y", strtotime($item->date))}}</td>
                                                <td class="text-end">{{ number_format($te, 2) }}</td>
                                                <td class="text-end">{{ number_format($ba, 2) }}</td>
                                                <td class="text-end">{{ number_format($gst, 2) }}</td>
                                                <td class="text-end">{{ number_format($qty + $bonus, 2) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="6" class="text-end">Total</th>
                                                <th class="text-end">{{number_format($totalTe, 2)}}</th>
                                                <th class="text-end">{{number_format($totalBA, 2)}}</th>
                                                <th class="text-end">{{number_format($totalBA * 18 / 100, 2)}}</th>
                                                <th class="text-end">{{number_format($totalQty, 2)}}</th>
                                            </tr>
                                        </tfoot>
                                    </table><!--end table-->
                                </div>

                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->

@endsection
<script>
    setTimeout(function() {
        window.print();
        window.history.back();
    }, 1000);
</script>