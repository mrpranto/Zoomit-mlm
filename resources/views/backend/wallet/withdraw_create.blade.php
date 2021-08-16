@extends('backend.layouts.app')

@section('title', 'Withdraw Create')

@section('page_title')

    Withdraw Create

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
            <form action="{{ route('withdraw.process') }}" method="post">
                @csrf
                <div class="card-box">
                    <div class="form-group row">
                        <label for="amount"
                               class="col-md-2 col-form-label text-md-right">Withdrawal Amount</label>

                        <div class="col-md-9">
                            <input id="amount" type="number" step="0.01"
                                   class="form-control @error('amount') is-invalid @enderror" name="amount"
                                   value="{{ old('amount') }}" autocomplete="amount" autofocus>

                            @error('amount')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="withdrawal_type"
                               class="col-md-2 col-form-label text-md-right">Withdrawal Type</label>

                        <div class="col-md-9">
                            <select name="withdrawal_type" id="withdrawal_type" class="form-control @error('withdrawal_type') is-invalid @enderror">
                                <option value="">- Withdrawal Type -</option>

                                @foreach($paymentTypes as $key => $paymentType)
                                    <option
                                        {{ old('payment_type') == $key ? 'selected' : '' }} value="{{ $key }}">{{ $paymentType }}</option>
                                @endforeach

                            </select>

                            @error('withdrawal_type')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="withdrawal_number"
                               class="col-md-2 col-form-label text-md-right">Withdrawal Number</label>

                        <div class="col-md-9">
                            <input id="withdrawal_number" type="number"
                                   class="form-control @error('withdrawal_number') is-invalid @enderror"
                                   name="withdrawal_number"
                                   value="{{ old('withdrawal_number') }}" autocomplete="withdrawal_number" autofocus>

                            @error('withdrawal_number')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="withdrawal_number"
                               class="col-md-2 col-form-label text-md-right"></label>

                        <div class="col-md-9">
                            <button class="btn btn-primary" type="submit"><i class="fe-save"></i> Save</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>


    </div>


@endsection

@push('js')

@endpush
