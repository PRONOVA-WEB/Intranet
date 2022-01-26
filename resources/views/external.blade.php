@extends('layouts.external')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {!! settings('site.external_description') !!}
                    <div class="float-right">
                        <a href="{{ route('replacement_staff.create') }}" class="btn btn-primary">Ingresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
