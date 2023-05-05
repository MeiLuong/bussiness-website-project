@extends('frontend.layout.master')

@section('body')
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="register-box">
                    <h2>Register</h2>
                    <form action="{{ route('postRegister') }}" method="POST">
                        @csrf
                        <div class="user-box">
                            <label class="label">Name<span class="btn-require">*</span></label>
                            <input type="text" placeholder="Name" id="name" class="form-controll" name="name" autofocus />
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="user-box">
                            <label class="label">Email<span class="btn-require">*</span></label>
                            <input type="text" placeholder="Email" id="email" class="form-controll" name="email" />
                            @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="user-box">
                            <label class="label">Phone<span class="btn-require">*</span></label>
                            <input type="text" placeholder="Phone" id="phone" class="form-controll" name="phone" />
                            @if($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                        <div class="user-box">
                            <label class="label">Address<span class="btn-require">*</span></label>
                            <input type="text" placeholder="Address" id="address" class="form-controll" name="address" />
                            @if($errors->has('address'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                        <div class="user-box">
                            <label class="label">Password<span class="btn-require">*</span></label>
                            <input type="password" placeholder="Password" id="password" class="form-controll" name="password" />
                            @if($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="user-box">
                            <input type="hidden" placeholder="" id="level" name="level" value="1">
                        </div>

                        <button type="submit" class="action register btn btn-primary btn-medium">REGISTER</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style type="text/css">

        .register-box {
            width: 100%;
            max-width: 600px;
            padding: 40px;
            background: rgba(255,255,255,.5);
            box-sizing: border-box;
            box-shadow: 0 15px 25px rgba(0,0,0,.6);
            border-radius: 10px;
            margin: 20px auto;
        }

        .register-box h2 {
            margin: 0 0 30px;
            padding: 0;
            color: #333;
            text-align: center;
        }

        .register-box .user-box {
            position: relative;
        }

        .register-box .user-box input {
            width: 100%;
            padding: 10px 0;
            font-size: 16px;
            color: #333;
            margin-bottom: 30px;
            border: none;
            border-bottom: 1px solid #333;
            outline: none;
            background: transparent;
        }
        .register-box .user-box label {
            padding: 10px 0;
            font-size: 16px;
            color: #333;
            pointer-events: none;
            transition: .5s;
        }

        .register-box .user-box input:focus ~ label,
        .register-box .user-box input:valid ~ label {
            top: -20px;
            left: 0;
            color: orange;
            font-size: 12px;
        }

        .register-box form a {
            position: relative;
            display: inline-block;
            padding: 10px 20px;
            /*color: #03e9f4;*/
            color: orange;
            font-size: 16px;
            text-decoration: none;
            text-transform: uppercase;
            overflow: hidden;
            transition: .5s;
            margin-top: 40px;
            letter-spacing: 4px
        }

        .register-box a:hover {
            background: orange;
            /*color: orange;*/
            color: #fff !important;
            border-radius: 5px;
            box-shadow: 0 0 5px orange,
            0 0 25px orange,
            0 0 50px orange,
            0 0 100px orange;
        }

        .register-box a span {
            position: absolute;
            display: block;
        }

        .register-box a span:nth-child(1) {
            top: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, orange);
            animation: btn-anim1 1s linear infinite;
        }

        @keyframes btn-anim1 {
            0% {
                left: -100%;
            }
            50%,100% {
                left: 100%;
            }
        }

        .register-box a span:nth-child(2) {
            top: -100%;
            right: 0;
            width: 2px;
            height: 100%;
            background: linear-gradient(180deg, transparent, orange);
            animation: btn-anim2 1s linear infinite;
            animation-delay: .25s
        }

        @keyframes btn-anim2 {
            0% {
                top: -100%;
            }
            50%,100% {
                top: 100%;
            }
        }

        .register-box a span:nth-child(3) {
            bottom: 0;
            right: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(270deg, transparent, orange);
            animation: btn-anim3 1s linear infinite;
            animation-delay: .5s
        }

        @keyframes btn-anim3 {
            0% {
                right: -100%;
            }
            50%,100% {
                right: 100%;
            }
        }

        .register-box a span:nth-child(4) {
            bottom: -100%;
            left: 0;
            width: 2px;
            height: 100%;
            background: linear-gradient(360deg, transparent, orange);
            animation: btn-anim4 1s linear infinite;
            animation-delay: .75s
        }

        @keyframes btn-anim4 {
            0% {
                bottom: -100%;
            }
            50%,100% {
                bottom: 100%;
            }
        }

    </style>
@endsection
