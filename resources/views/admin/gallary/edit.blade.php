@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <section id="multiple-validation">
            <div class="row">
                <div class="col-12 col-sm-5">
                    <div class="media d-flex align-items-center">
                        <h4 >Update Account ({{$user->full_name}}) </h4>
                    </div>
                </div>
                <div class="col-12 col-sm-7 d-flex justify-content-end align-items-center">
                    <a href="{{url('admin/users')}}" class="btn btn-sm btn-primary px-3 py-1 ml-2">Go
                        Back</a>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        
                        {!! Form::model($user, [
                        'method' => 'PATCH',
                        'url' => ['/admin/users', $user->id],
                        'class' => 'form-horizontal',
                        'files' => true,
                        'autocomplete'=>'off'
                        ]) !!}
                        
                            @include ('admin.users.form')
                        
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection