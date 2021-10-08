@extends('layout.layout')
@section('content')

<style>
    .my-form {
        color: #305896;
    }
    .my-form .btn-default {
        background-color: #305896;
        color: #fff;
        border-radius: 0;
    }
    .my-form .btn-default:hover {
        background-color: #4498C6;
        color: #fff;
    }
    .my-form .form-control {
        border-radius: 0;
    }
    .address-icon i{
        font-size: 36px;
        line-height: 32px;
    }
    .icons i{
        color: #fff;
        padding: 8px 0px;
        text-align: center;
        height: 30px;
        width: 30px;
        margin-right: 5px;
    }
</style>


<div class="container" style="margin-bottom: 20px;">
    <div class="row bg-light pt-3 pb-3 mb-4" style="background-color: #F4F4F4; margin: 30px 0px;">
        <div class="col-lg-12">
            <br><h4>ADDRESS :</h4>
        </div>
        <div class="col-lg-4 col-4">
            <p>
                Saint Marco Street,
                6th floor,Tokyo,
                Japan, 123456.
            </p>
        </div>
        <div class="col-lg-4 col-4">
            <p class="m-0 text-danger"><i class="fa fa-phone-square" aria-hidden="true"></i>
                +91 1234567890
            </p>
            <p class="m-0 text-info"><i class="fa fa-envelope" aria-hidden="true"></i>
                example@gmail.com
            </p>
        </div>
        <div class="col-lg-4 col-4 address-icon text-center text-danger">
            <i class="fa fa-map-marker" aria-hidden="true"> Address</i><p>
                Saint Marco Street,
                6th floor,Tokyo,
                Japan, 123456.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div id="googlemap" style="width:100%; height:400px;"></div>
        </div>
        <br />
        <div class="col-md-6" style="background-color: #F4F4F4; padding: 20px 10px;">
            <form class="my-form">
                <div class="form-group">
                    <label for="form-name">Name</label>
                    <input type="email" class="form-control" id="form-name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="form-email">Email Address</label>
                    <input type="email" class="form-control" id="form-email" placeholder="Email Address">
                </div>
                <div class="form-group">
                    <label for="form-subject">Telephone</label>
                    <input type="text" class="form-control" id="form-subject" placeholder="Subject">
                </div>
                <div class="form-group">
                    <label for="form-message">Email your Message</label>
                    <textarea class="form-control" id="form-message" placeholder="Message"></textarea>
                </div>
                <button class="btn btn-secondary text-right" type="submit">Contact Us</button>           
            </form>
        </div>
    </div>
</div>



<script src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript">
    jQuery(function ($) {
        // Google Maps setup
        var googlemap = new google.maps.Map(
            document.getElementById('googlemap'),
            {
                center: new google.maps.LatLng(44.5403, -78.5463),
                zoom: 8,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
        );
    });
</script>




@endsection