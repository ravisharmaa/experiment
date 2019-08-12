<style>
.loginPanel--wraper{
    display: flex;
    flex-flow: column;
    height: 100vh;
    width: 100%;
    font-family: 'Open Sans', sans-serif;
    color: #686E73;
    font-size: 13px;
    justify-content: center;
    margin-top: 0;
    position: relative;
}
.graphicBg{
    background-color: #34383c;
    width: 100%;
    height: 30%;
    position: absolute;
    top: -45px;
}
.loginPanel{
    padding: 40px;
    background-color: #fff;
    max-width: 390px;
    width: 100%;
    height: 100%;
    max-height: 460px;
    margin: 0 auto;
    position: absolute;
    top: 0;
    left: 50%;
    transform: translate(-50%, 10%);
    border-radius: 6px;
    box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.12);
}
.loginPanel a{
    color: #00965e;
}
.loginPanel a:hover, .loginPanel a:focus {
    color: #45b289;
    text-decoration: none;
}
.loginPanel .form-group {
    position: relative;
    margin-bottom: 1.5rem;
  }
  
  .loginPanel .form-control-placeholder {
    position: absolute;
    top: 0;
    padding: 7px 0 0 13px;
    transition: all 200ms;
    opacity: 0.5;
  }
  
  .loginPanel .form-control:focus + .form-control-placeholder,
  .loginPanel .form-control:valid + .form-control-placeholder{
    font-size: 75%;
    transform: translate3d(0, -100%, 0);
    opacity: 1;
    font-size: 14px;
  }
  .styled-checkbox {
  position: absolute;
  opacity: 0;
}
.styled-checkbox + label {
  position: relative;
  cursor: pointer;
  padding: 0;
}
.styled-checkbox + label:before {
  content: "";
  margin-right: 10px;
  display: inline-block;
  vertical-align: text-top;
  width: 20px;
  height: 20px;
  background: #d8d8d8;
  border-radius:4px;
}
.styled-checkbox:hover + label:before {
  background: #00965e;
}
.styled-checkbox:focus + label:before {
  box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.12);
}
.styled-checkbox:checked + label:before {
  background: #45b289;
}
.styled-checkbox:disabled + label {
  color: #b8b8b8;
  cursor: auto;
}
.styled-checkbox:disabled + label:before {
  box-shadow: none;
  background: #ddd;
}
.styled-checkbox:checked + label:after {
  content: "";
  position: absolute;
  left: 5px;
  top: 9px;
  background: white;
  width: 2px;
  height: 2px;
  box-shadow: 2px 0 0 white, 4px 0 0 white, 4px -2px 0 white, 4px -4px 0 white, 4px -6px 0 white, 4px -8px 0 white;
  -webkit-transform: rotate(45deg);
          transform: rotate(45deg);
}
.btn--primary{
        opacity: 0.9;
        background-color: #00965e;
        background-image: linear-gradient(to right, #00965e 0%, #03ad6d 50%, #92d868 100%);
        color: #fff;
        border: none;
        color:#fff;
}
.loginInfo{
    display:flex;
    flex-flow:row nowrap;
    margin:30px 0px;
}
.loginInfo__right{
    margin-left:auto;
}
.loginPanel .form-control{
    height:42px;
    background-color:#f6f9f6;
    border:none;
    font-size: 13px;
}
.loginPanel .btn{
    display:block;
    width:100%;
    padding:10px 40px;
    color:#fff;
}
.loginPanel__brand >div{
    width: 58px;
    height: 58px;
    border-radius:50px;
    box-shadow:0px 1px 4px rgba(0,0,0,0.12);
    background-color:#fff;
}
.loginPanel__brand >div>img{
    max-width:100%;
    margin:6px auto;
}
.loginPanel__name, .loginPanel__brand{
    text-align:center;
    display:flex;
    flex-flow:row;
    justify-content:Center;
    align-items: center;
    margin:0px 0px 20px 0;
}
.loginPanel__brand {
    margin: -66px 0px 25px 0px;
}
.loginPanel__brandname h4{
    font-size:20px;
}
</style>

@extends('layouts.app')

@section('content')



<div class="loginPanel--wraper">
    <div class="graphicBg"></div>
  <div class="loginPanel">
    <div class="loginPanel__brand">
        <div><img src="{{asset('images/logo.png')}}"/></div>
        
    </div>
    <div class="loginPanel__name">
        <h4>Login</h4>
    </div>
    <form method="POST" action="/login">
        @csrf
        <div class="form-group">
            <input type="email" id="name" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required autofocus>
            @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
        </div>
        <div class="form-group">
            <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" required>
        </div>
        <div class="loginInfo">
            <div class="loginInfo__left">
                <input class="styled-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember"> {{ __('Remember Me') }}</label>
                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif 
            </div>
            <div class="loginInfo__right">
                <a href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn--primary">
            {{ __('Login') }}
            </button>
        </div>
    </form>
  </div>
</div>

@endsection
