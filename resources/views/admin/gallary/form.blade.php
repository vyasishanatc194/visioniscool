
<div class="card-content">
    <div class="card-body">
        <form novalidate="">
            <div class="row">
                <div class="col-md-6 col-12">
                    
                    <h6>Select City</h6>
                    <div class="form-group">
                        
                        <select name="selectedCity" class="select2 form-control">
                            @foreach($states as $state)
                            <optgroup label="{{$state->state_name}}">
                                @foreach($state->getCity as $city)
                                <option value="{{$city->id}}">{{$city->city_name.', '.$state->state_name}}</option>
                                @endforeach
                                
                            </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <fieldset class="form-group">
                        <label for="inputGroupFile01">Upload Desktop Image</label>
                        <div class="custom-file">
                            <input type="file" name="image" accept="image/*" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-6 col-12">
                    <fieldset class="form-group">
                        <label for="inputGroupFile01">Upload Mobile Image</label>
                        <div class="custom-file">
                            <input type="file" name="mobile_image" accept="image/*" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </fieldset>
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
<script>
    $('.custom-file input').change(function (e) {
    $(this).next('.custom-file-label').html(e.target.files[0].name);
    });
</script>
@endpush