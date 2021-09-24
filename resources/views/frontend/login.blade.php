@extends('layouts.frontend.design')
@section('title','Copy Writer Questionnaire Login')
@section('section')
    <div class="main">
        <h1>Semster Exam System - User Login</h1>
        <div class="segment" style="margin-right:30px;">
            <img src="{{ asset('assets/frontend/img/test.png') }}"/>
        </div>
        <div class="segment">
        <form action="{{ url('/user/login') }}" method="post">
            @csrf
            <table class="tbl">
                <tr>
                <td>Username or Email</td>
                <td><input name="email" type="text"></td>
                </tr>
                <tr>
                <td>Password </td>
                <td><input name="password" type="password"></td>
                </tr>

                <tr>
                <td></td>
                <td><input type="submit" name="login" value="Login">
                </td>
                </tr>
        </table>
        </form>
        <p>Forget Password? <a href="{{ route('forget.password') }}">Click to </a>recover now</p>
        <br>
        <p>New User ? <a href="{{ route('user.registration') }}">Signup</a> Free</p>
        </div>
    </div>

@endsection