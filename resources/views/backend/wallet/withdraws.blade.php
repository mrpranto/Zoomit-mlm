@extends('backend.layouts.app')

@section('title', 'Withdraws')

@section('page_title')

    Withdraws &nbsp; @include('backend.partials._recordCount', ['data' => $withdraws])

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
                            <th>Withdraw Amount</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($withdraws as $key => $withdraw)
                            <tr>
                                <td>{{ $withdraws->firstItem()+$key }}</td>
                                <td>{{ dateFormat($withdraw->created_at) }}</td>
                                <td>{{ currency($withdraw->amount) }}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            @include('backend.partials._paginate', ['data' => $withdraws])

        </div>
    </div>


@endsection

@push('js')

@endpush
