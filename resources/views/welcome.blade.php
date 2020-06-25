
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Vision Is Cool</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('/assets/css/font-awesome.min.css')}}">

    <script src="{{ asset('assets/js/jquery.min.js')}}" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css')}}" type="text/css" media="screen" charset="utf-8" />
    <script src="{{ asset('assets/js/slick.min.js')}}" type="text/javascript" charset="utf-8"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css')}}" />
</head>

<body>
<?php
    // $base_dir = 'assets/collections_old/';
    // $collection_data = [];
    // $states = array_diff(scandir($base_dir), ['..', '.', '.DS_Store']);
   
    // foreach ($states as $state) {
    //     $cities = array_diff(scandir($base_dir . $state), ['..', '.', '.DS_Store']);
      
    //   foreach ($cities as $city) {
    //     $images = array_diff(scandir($base_dir . $state . '/' . $city), ['..', '.', '.DS_Store']);
        
    //     foreach ($images as $image) {
    //       if (substr_count($image, 'mobile__')) {
    //         $collection_data[$state . '/' . $city]['mobile'][] = $base_dir . $state . '/' . $city . '/' . $image;
    //       } else {
    //         $collection_data[$state . '/' . $city]['desktop'][] = $base_dir . $state . '/' . $city . '/' . $image;
    //       }
    //     }
    //   }
    // }
   
  ?>
    <div class="wrapper">
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
    
    <script type="text/javascript">
        var ajaxUrl = '{{url('get/image')}}';
    </script>
    <script type="text/javascript" src="{{ asset('assets/js/script.js')}}"></script>
</body>

</html>