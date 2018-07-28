@extends('Admin.login-parent')

@section('konten')


<div class="m-grid__item m-grid__item--fluid m-login__wrapper">
    <div class="m-login__container">
        <div class="m-login__logo">
            <a href="#">
                <img src="../../../assets/app/media/img//logos/logo-1.png">
            </a>
        </div>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        {!! Form::open(['url'=>'login','class'=>'m-login__form m-form']) !!}

        <div class="m-login__signin">
            <div class="m-login__head">
                <h3 class="m-login__title">
                    Sign In
                </h3>
            </div>
            <div class="form-group m-form__group{{$errors->has('email')?'has-error' :''}}">
                {!! Form::email('email',null,['class'=>'form-control m-input','placeholder'=>'Email']) !!}
                {!! $errors->first('email','<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group m-form__group{{$errors->has('password')?'has-error' :''}}">
                <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
                {!! $errors->first('password','<p class="help-block">:message</p>') !!}
            </div>
            <div class="row m-login__form-sub">
                <div class="col m--align-left m-login__form-left">
                    <label class="m-checkbox  m-checkbox--light">
                        {!! Form::checkbox('remember') !!}
                        Remember me
                        <span></span>
                    </label>
                </div>
                <div class="col m--align-right m-login__form-right">
                    <a href="javascript:;" id="m_login_forget_password" class="m-link">
                        Forget Password ?
                    </a>
                </div>
            </div>
            <div class="m-login__form-action">
                <button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primary">
                    Sign In
                </button>
            </div>
        </div>
        {!! Form::close() !!}
        
        <div class="m-login__forget-password">
            <div class="m-login__head">
                <h3 class="m-login__title">
                    Forgotten Password ?
                </h3>
                <div class="m-login__desc">
                    Enter your email to reset your password:
                </div>
            </div>
            {!! Form::open(['url'=>'/password/email','class'=>'m-login__form m-form']) !!}
            <form class="m-login__form m-form" action="">
                <div class="form-group m-form__group">
                    <input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">
                    {!! $errors->first('email','<p class="help-block">:message</p>') !!}
                </div>
                <div class="m-login__form-action">
                    <button type="submit" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn">
                    </i> Kirim link reset password
                </button>
                &nbsp;&nbsp;
                <button id="m_login_forget_password_cancel" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn">
                    Cancel
                </button>
            </div>
        </form>
        {!! Form::close() !!}
    </div>
    <div class="m-login__account">
        <span class="m-login__account-msg">
            Don't have an account yet ?
        </span>
        &nbsp;&nbsp;
        <a href="{{URL('/register')}}" class="m-link m-link--light m-login__account-link">
            Sign Up
        </a>
    </div>
</div>
</div>


@endsection

