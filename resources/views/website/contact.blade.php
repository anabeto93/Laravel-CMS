@extends('website.template.master')

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url({{ asset('website/img/contact-bg.jpg') }})">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="page-heading">
                        <h1>Contact Me</h1>
                        <span class="subheading">Have questions? I have answers.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>

                <div class="row">
                    <div class="col">
                        @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                {{ Session('message')}}
                            </div>
                        @endif
                    </div>
                </div>
                <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
                <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
                <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
                <form name="sentMessage" id="contactForm" method="post" action="{{ route('contact.store') }}">
                    @csrf
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls @if($errors->has('name')) has-error @endif">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" placeholder="Name" id="name" name="name" required data-validation-required-message="Please enter your name.">
                            @if($errors->has('name'))
                            <p class="help-block text-danger"></p>
                            @endif
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls @if($errors->has('email')) has-error @endif">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" placeholder="Email Address" id="email" name="email" required data-validation-required-message="Please enter your email address.">
                            @if($errors->has('email'))
                            <p class="help-block text-danger"></p>
                            @endif
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls @if($errors->has('phone')) has-error @endif">
                            <label for="phone">Phone Number</label>
                            <input type="tel" class="form-control" placeholder="Phone Number" id="phone" name="phone" required data-validation-required-message="Please enter your phone number.">
                            @if($errors->has('phone'))
                            <p class="help-block text-danger"></p>
                            @endif
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls @if($errors->has('message')) has-error @endif">
                            <label for="message">Message</label>
                            <textarea rows="5" class="form-control" placeholder="Message" id="message" name="message" required data-validation-required-message="Please enter a message."></textarea>
                            @if($errors->has('message'))
                            <p class="help-block text-danger"></p>
                            @endif
                        </div>
                    </div>
                    <br>
                    <div id="success"></div>
                    <button type="submit" class="btn btn-primary" id="sendMessageButton">Send</button>
                </form>
            </div>
        </div>
    </div>
@endsection
