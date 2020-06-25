@extends('layouts.app')

@section('content')
            <!-- BEGIN : Main Content-->
<div class="main-content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="card bg-info bg-lighten-3">
                    <div class="card-content">
                        <div class="card-body py-0">
                            <div class="media">
                                <div class="media-body info text-left">
                                    <h3 class="font-large-1 info mb-0">$15,678</h3>
                                    <span>Total Cost</span>
                                </div>
                                <div class="media-right info text-right">
                                    <i class="ft-percent font-large-1"></i>
                                </div>
                            </div>
                        </div>
                        <div id="Widget-line-chart"
                            class="height-75 WidgetlineChart WidgetlineChartShadow WidgetChart1 mb-3"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="card bg-warning bg-lighten-3">
                    <div class="card-content">
                        <div class="card-body py-0">
                            <div class="media">
                                <div class="media-body warning text-left">
                                    <h3 class="font-large-1 warning mb-0">$2156</h3>
                                    <span>Total Tax</span>
                                </div>
                                <div class="media-right warning text-right">
                                    <i class="ft-activity font-large-1"></i>
                                </div>
                            </div>
                        </div>
                        <div id="Widget-line-chart2"
                            class="height-75 WidgetlineChart WidgetlineChartShadow WidgetChart2 mb-3"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="card bg-primary bg-lighten-3">
                    <div class="card-content">
                        <div class="card-body py-0">
                            <div class="media">
                                <div class="media-body primary text-left">
                                    <h3 class="font-large-1 primary mb-0">$45,668</h3>
                                    <span>Total Sales</span>
                                </div>
                                <div class="media-right primary text-right">
                                    <i class="ft-trending-up font-large-1"></i>
                                </div>
                            </div>
                        </div>
                        <div id="Widget-line-chart3"
                            class="height-75 WidgetlineChart WidgetlineChartShadow WidgetChart3 mb-3"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="card bg-success bg-lighten-3">
                    <div class="card-content">
                        <div class="card-body py-0">
                            <div class="media">
                                <div class="media-body success text-left">
                                    <h3 class="font-large-1 success mb-0">$32,454</h3>
                                    <span>Total Earning</span>
                                </div>
                                <div class="media-right success text-right">
                                    <i class="ft-credit-card font-large-1"></i>
                                </div>
                            </div>
                        </div>
                        <div id="Widget-line-chart4"
                            class="height-75 WidgetlineChart WidgetlineChartShadow WidgetChart4 mb-3"></div>
                    </div>
                </div>
            </div>
        </div>
        
        

        

    </div>
</div>
            <!-- END : End Main Content-->
    
            
    
        
    

@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard2.css') }}">
<link rel="stylesheet" href="{{ asset('app-assets/fonts/weathericons/css/weather-icons.css') }}">
<link rel="stylesheet" href="{{ asset('app-assets/fonts/weathericons/css/weather-icons-wind.css') }}">    
@endpush