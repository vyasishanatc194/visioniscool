
<div class="card-content">
    <div class="card-body">
        <form novalidate="">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
                        <div class="controls">
                            <label>First Name</label>
                             <input type="text" name="first_name" class="form-control" placeholder="Your First Name" required="" autocomplete="off" data-validation-required-message="This first name field is required" value="{{(isset($user) && $user !== null) ? $user->first_name : ''}}">
                            <div class="help-block"></div>
                            {!! $errors->first('first_name', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
                        <div class="controls">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control" placeholder="Your Last Name" required="" autocomplete="off" data-validation-required-message="This last name field is required" value="{{(isset($user) && $user !== null) ? $user->last_name : ''}}">
                            <div class="help-block"></div>
                            {!! $errors->first('last_name', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                        <div class="controls">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                placeholder="Your Email" autocomplete="off" required="" data-validation-required-message="The email field is required" value="{{(isset($user) && $user !== null) ? $user->email : ''}}">
                            <div class="help-block"></div>
                            {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                        <div class="controls">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control"
                        placeholder="Your Password" <?php if(!isset($user)) { ?> required="" autocomplete="off" data-validation-required-message="The password field is required" minlength="6" <?php } ?> >
                            <div class="help-block"></div>
                            {!! $errors->first('password', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group {{ $errors->has('con-password') ? 'has-error' : ''}}">
                        <div class="controls">
                            <label>Confirm Password</label>
                            <input type="password" name="con-password" class="form-control"
                                placeholder="Confirm Password" <?php if(!isset($user)) { ?> required="" autocomplete="off" data-validation-match-match="password" data-validation-required-message="The Confirm password field is required" minlength="6" <?php } ?>  >
                            <div class="help-block"></div>
                            {!! $errors->first('con-password', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                        <div class="controls">
                            <label>Phone</label>
                            <input type="tel" name="phone" class="form-control" placeholder="Phone no." required="" autocomplete="off" data-validation-required-message="This Phone no. field is required" value="{{(isset($user) && $user !== null) ? $user->phone : ''}}">
                            <div class="help-block"></div>
                            {!! $errors->first('phone', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group {{ $errors->has('business_name') ? 'has-error' : ''}}">
                        <div class="controls">
                            <label>Business Name</label>
                            <input type="text" name="business_name" class="form-control" placeholder="Business Name" required="" autocomplete="off"
                                data-validation-required-message="This Business Name field is required" value="{{(isset($user) && $user !== null) ? $user->business_name : ''}}">
                            <div class="help-block"></div>
                            {!! $errors->first('business_name', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group {{ $errors->has('location') ? 'has-error' : ''}}">
                        <div class="controls">
                            <label>Location</label>
                            <input type="text" name="location" class="form-control" placeholder="Location" required="" autocomplete="off" data-validation-required-message="This Location field is required" value="{{(isset($user) && $user !== null) ? $user->location : ''}}">
                            <div class="help-block"></div>
                            {!! $errors->first('location', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group {{ $errors->has('company_domain') ? 'has-error' : ''}}">
                        <div class="controls">
                            <label>Company Domain</label>
                            <input type="tel" name="company_domain" class="form-control" placeholder="Company Domain" required="" autocomplete="off" data-validation-required-message="This Company Domain field is required" value="{{(isset($user) && $user !== null) ? $user->company_domain : ''}}">
                            <div class="help-block"></div>
                            {!! $errors->first('company_domain', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/form-validation.css')}}">
@endpush
@push('js')
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{ asset('app-assets/vendors/js/jqBootstrapValidation.js')}}"></script>
<script src="{{ asset('app-assets/js/form-validation.js')}}"></script>
<!-- END PAGE LEVEL JS-->
@endpush