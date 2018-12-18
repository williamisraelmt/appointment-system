@extends('layouts.app')

@section('content')
    <div class="my-3 my-md-5">
        <div class="container" style="max-width: 1400px!important;">
            <div class="row row-cards row-deck">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <appointment-component type="all"></appointment-component>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection