@extends('backend.layouts.app')

@section('title', 'Set Commission')

@section('page_title')

    Set Commission

@endsection

@section('actions')


@endsection

@push('css')


@endpush

@section('content')



    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2">
            <div class="card-box">
                <form action="{{ route('store.commission') }}" method="post">
                    @csrf

                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="bg-soft-secondary">Level</th>
                                    <th class="bg-soft-secondary">Member</th>
                                    <th class="bg-soft-secondary">Commission</th>
                                    <th class="bg-soft-secondary">Rank</th>
                                    <th class="bg-soft-secondary">Notification</th>
                                </tr>

                                @foreach($commissions as $key => $commission)
                                    <input type="hidden" value="{{ $commission->id }}" name="commission_id[]">
                                    <tr>
                                        <th><p>Level: {{ $commission->level_name }}</p></th>
                                        <th><input type="number" name="level_minimum_member[]" value="{{ $commission->level_minimum_member }}" class="form-control" placeholder="Level minimum member"></th>
                                        <td><input type="number" step="0.01" name="commission_amount[]" value="{{ $commission->commission }}" class="form-control" placeholder="Commission Amount"></td>
                                        <td><input type="text" name="rank[]" value="{{ $commission->rank }}" class="form-control" placeholder="Rank"></td>
                                        <td><input type="text" name="notification[]" value="{{ $commission->notification }}" class="form-control" placeholder="Notification message ..."></td>
                                    </tr>

                                @endforeach

                            </table>
                        </div>
                    </div>

                    <div class="col-12 mt-2 text-right">
                        <button class="btn btn-primary"><i class="fe-save"></i> Save Commission</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection

@push('js')



@endpush
