@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <section id="multiple-validation">
            <div class="row">
                <div class="col-12 col-sm-5">
                    <div class="media d-flex align-items-center">
                        <h4>Add Image </h4>
                    </div>
                </div>
                <div class="col-12 col-sm-7 d-flex justify-content-end align-items-center">
                    <a href="{{url('admin/gallary')}}" class="btn btn-sm btn-primary px-3 py-1 ml-2">Go Back</a>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        
                        {!! Form::open(['url' => '/admin/gallary', 'class' => 'form-horizontal','files' => true,'autocomplete'=>'off']) !!}
                        
                            @include ('admin.gallary.form')
                        
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection