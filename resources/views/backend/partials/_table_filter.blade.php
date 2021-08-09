<form action="" id="filter">
    <div class="form-group row">
        <div class="col-12 col-sm-1 col-md-1 mb-2">
            <select name="per_page" class="form-control form-control-sm" id="per_page" autocomplete="off" tabindex="-1">
                @foreach(config('file.per_page') as $per_page)
                    <option {{ request('per_page') == $per_page ? 'selected' : '' }} value="{{ $per_page }}">{{ $per_page }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-2 col-md-2 offset-md-9 mb-2">
            <div class="input-group">
                <input type="text" class="form-control form-control-sm" name="search" value="{{ request('search') }}" autocomplete="name" autofocus>
                <div class="input-group-append">
                    <button class="btn btn-white btn-sm waves-effect waves-light" type="submit"><i class="fe-search"></i></button>
                </div>
            </div>
        </div>
    </div>
</form>
