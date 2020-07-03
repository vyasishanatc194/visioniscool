
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Vision Is Cool</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/assets/css/font-awesome.min.css')}}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('assets/js/jquery.min.js')}}" type="text/javascript" charset="utf-8"></script> --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css')}}" type="text/css" media="screen" charset="utf-8" />
    <link rel="stylesheet" href="{{ asset('assets/css/vs-brand.css')}}" type="text/css" media="screen" charset="utf-8" />
    <script src="{{ asset('assets/js/slick.min.js')}}" type="text/javascript" charset="utf-8"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css')}}" />
</head>

<body>
    <div class="wrapper">
        <div id="loading">
            <div class="loader-center">
                <img id="loading-image" src="{!! asset('assets/images/loading.gif') !!}"
                    alt="Loading..." />
            </div>
        </div>
        <div class="container">
            <div class="content main-content">
                <div class="main-background-wrapper">
                    <div class="main-background-content">
                    </div>
                </div>
                <div class="location-selector">
                    <select>
                        @foreach($statesDB as $state)
                        <optgroup label="{{$state->state_name}}">
                            @foreach($state->getCity as $city)
                            <option value="{{$city->id}}">{{$city->city_name.', '.$state->state_name}}</option>
                            @endforeach
                        
                        </optgroup>
                        @endforeach
                    </select>
                </div>
                <div class="marker">#visioniscool</div>
                <div class="credit">Photo: Forrest Renaissance</div>
            </div>
        </div>
    </div>
    
    <div id="modal-getpair" class="modal fade modal-custom" role="dialog">
        <div class="modal-dialog">
    
            <!-- Modal content-->
            <div class="modal-content">
    
                <div class="modal-body">
    
                    <div class="modal-content-getpair">
                        <h3>Get a pair of glasses for free!</h3>
    
                        <div class="galss-frame">
                            <img src="{{ asset('assets/images/frame-glass-2.png')}}" alt="">
                        </div>
    
                        <div class="form-group">
                            <input type="email" id="email" class="form-control" placeholder="Enter Mail" />
                        </div>
    
                        <div class="btn-div">
                            <button type="button" class="btn btn-join-us" id="join">Join Us</button>
                        </div>
    
                        <div class="modal-footer-content">
                            <h3>Inspire Confidence. Give Vision</h3>
                            <a href="#" data-toggle="modal" data-target="#modal-readmore" class="readmore-text">READ MORE </a>
                            <a href="#" class="privacy-policy">Privacy Policy</a>
                        </div>
                    </div>
    
    
                </div>
    
            </div>
    
        </div>
    </div>
    @include('modal.readmore')
    <script type="text/javascript">
        var ajaxUrl = '{{url('get/image')}}';
        $( document ).ready(function() {
            $("#modal-getpair").modal('show');
            $(".readmore-text").click(function(){
                $("#modal-getpair").modal('hide');
            });
            $("#join").click(function(){
                var email = $("#email").val();
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if(regex.test(email)){
                    $.ajax({
                        url: '{{url('newsletter')}}',
                        type: 'post',
                        data: {
                           email: email
                        },
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        dataType: 'json',
                        success: function (data) {
                            window.location.href = "{{url('thankyou')}}";
                        }
                    });
                    
                }else{
                    alert('Email is not valid, Please enter valid email ')
                }
            
            })
        });
    </script>
    
    <script type="text/javascript" src="{{ asset('assets/js/script.js')}}"></script>
</body>

</html>