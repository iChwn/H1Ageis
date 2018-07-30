@extends('Admin.login-parent')

@section('konten')
<div class="m-grid__item m-grid__item--fluid m-login__wrapper">
    <div class="m-login__container">

       
        <div class="m-login__head">
            <h3 class="m-login__title">
                Sign Up
            </h3>
            <div class="m-login__desc">
                Enter your details to create your account:
            </div>
        </div>

        {!! Form::open(['url'=>'register','class'=>'m-login__form m-form']) !!}
        <div class="form-group m-form__group{{$errors->has('name')?'has-error':''}}">
            <input class="form-control m-input" type="text" placeholder="Nama" name="name">
            {!! $errors->first('name','<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group m-form__group{{$errors->has('email')?'has-error':''}}">
            <input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
            {!! $errors->first('email','<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group m-form__group{{$errors->has('password')?'has-error':''}}">
            <input class="form-control m-input" type="password" placeholder="Password" name="password">
            {!! $errors->first('password','<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group m-form__group{{$errors->has('password_confirmation')?'has-error':''}}">
            <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirm Password" name="password_confirmation">
            {!! $errors->first('password_confirmation','<p class="help-block">:message</p>') !!}
        </div>
        <p></p>
        <div class="form-group m-form__group{{$errors->has('g-recaptcha-response')?'has-error':''}}">
            <center>
                {!! app('captcha',['class'=>'col-md-12'])->display() !!}
                {!! $errors->first('g-recaptcha-response', '<p class="help-block">:message</p>') !!}
            </center>
        </div>
               {{--  <div class="row form-group m-form__group m-login__form-sub">
                    <div class="col m--align-left">
                        <label class="m-checkbox m-checkbox--light">
                            <input type="checkbox" name="agree">
                            I Agree the
                            <a href="#" class="m-link m-link--focus">
                                terms and conditions
                            </a>
                            .
                            <span></span>
                        </label>
                        <span class="m-form__help"></span>
                    </div>
                </div> --}} 
                {{-- Accept Aggrement --}}
                <div class="m-login__form-action">
                    <button class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
                        Sign Up
                    </button>
                    &nbsp;&nbsp;
                    <a href="{{URL('login')}}" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn">
                        Cancel
                    </a>
                </div>
                {!! Form::close() !!}

            </div>

        </div>

    </div>
</div>


@endsection

