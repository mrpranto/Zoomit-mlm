@if($data->total() > $data->perPage())
<nav aria-label="Page navigation example" class="mt-4 d-none d-sm-block d-md-block">
    <ul class="pagination pagination-rounded justify-content-end">
        <li class="page-item @if($data->appends(request()->query())->currentPage() == 1) disabled @endif">
            <a class="page-link waves-effect" href="{{ $data->appends(request()->query())->url(1) }}" tabindex="-1">← {{ __t('first') }}</a>
        </li>
        <li class="page-item @if($data->appends(request()->query())->currentPage() == 1) disabled @endif">
            <a class="page-link waves-effect" href="{{ $data->appends(request()->query())->previousPageUrl() }}" tabindex="-1">{{ __t('previous') }}</a>
        </li>
        @foreach(range(1, $data->appends(request()->query())->lastPage()) as $i)
            @if($i >= $data->appends(request()->query())->currentPage() - 2 && $i <= $data->appends(request()->query())->currentPage() + 2)
                @if ($i == $data->appends(request()->query())->currentPage())
                    <li class="page-item active"><span class="page-link waves-effect">{{ $i }}</span></li>
                @else
                    <li class="page-item"><a class="page-link waves-effect" href="{{ $data->appends(request()->query())->url($i) }}">{{ $i }}</a></li>
                @endif
            @endif
        @endforeach
        <li class="page-item @if($data->appends(request()->query())->lastPage() == $data->appends(request()->query())->currentPage()) disabled @endif">
            <a class="page-link waves-effect" href="{{ $data->appends(request()->query())->nextPageUrl() }}">{{ __t('next') }}</a>
        </li>
        <li class="page-item @if($data->appends(request()->query())->lastPage() == $data->appends(request()->query())->currentPage()) disabled @endif">
            <a class="page-link waves-effect" href="{{ $data->appends(request()->query())->url($data->lastPage()) }}">{{ __t('last') }} →</a>
        </li>
    </ul>
</nav>

<nav aria-label="Page navigation example" class="mt-4 d-sm-none d-md-none">
    <ul class="pagination pagination-rounded justify-content-end">
        <li class="page-item @if($data->appends(request()->query())->currentPage() == 1) disabled @endif">
            <a class="page-link waves-effect" href="{{ $data->appends(request()->query())->previousPageUrl() }}" tabindex="-1">{{ __t('previous') }}</a>
        </li>
        <li class="page-item @if($data->appends(request()->query())->lastPage() == $data->appends(request()->query())->currentPage()) disabled @endif">
            <a class="page-link waves-effect" href="{{ $data->appends(request()->query())->nextPageUrl() }}">{{ __t('next') }}</a>
        </li>
    </ul>
</nav>

@endif
