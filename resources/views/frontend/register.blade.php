@extends('layouts.frontend.design')
@section('title','Registration Form-Semster Exam System')
@section('section')
    <div class="main">
    <h1>Semster Exam System - User Registration</h1>
        <div class="segment" style="margin-right:20px;width:362px">
            <img src="{{ asset('assets/frontend/img/regi.png') }}"/>
        </div>
        <div class="segment" style="width:362px">
           
        <form action="{{ url('registration/store') }}" method="post">
            @csrf
            <table>
            <tr>
            <td>Copy Writer Questionnaire</td>
            <td><input type="text" name="name"></td>
            </tr>
            <tr>
            <td>Username</td>
            <td><input name="username" type="text" id="username" id="username"></td>
            </tr>
            <tr>
            <td>Password</td>
            <td><input type="password" name="password"></td>
            </tr>

            <tr>
            <td>E-mail</td>
            <td><input name="email" type="text" id="email"></td>
            </tr>
            <tr>
            <td></td>
            <td><input type="submit" name="Submit" value="Signup">
            </td>
            </tr>
        </table>
        </form>
        <p>Already Registered ? <a href="{{url('/')}}">Login</a> Here</p>
        </div>

    </div>
@endsection