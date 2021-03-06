@extends('backend.layouts.app')

@section('title', 'Incomes')

@section('page_title')

    Incomes &nbsp; @include('backend.partials._recordCount', ['data' => $incomes])

@endsection

@section('actions')

    @can('app.user.create')

    @endcan

@endsection

@push('css')



@endpush

@section('content')



    <div class="row">

        <div class="col-12 col-sm-12">
{{--            @include('backend.partials._table_filter')--}}

            <div class="card-box">
                <div class="table-responsive">
                    <table class="tablesaw table">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Date</th>
                            <th>Income Amount</th>
                        </tr>
                        </thead>
                        <tbody>

                        @php
                            $total = 0;
                        @endphp
                        @foreach($incomes as $key => $income)
                            <tr>
                                <td>{{ $incomes->firstItem()+$key }}</td>
                                <td>{{ dateFormat($income->created_at) }}</td>
                                <td>{{ currency($income->amount) }}</td>
                            </tr>
                            @php
                                $total += $income->amount
                            @endphp
                        @endforeach
                        <tr>
                            <th>Total:</th>
                            <th></th>
                            <th>{{ currency($total) }}</th>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            @include('backend.partials._paginate', ['data' => $incomes])

        </div>
    </div>


@endsection

@push('js')

@endpush
