
@extends('layouts.backend.design')
@section('title','Semster Admin Login')
@section('section')
    <div class="main">
    <h1 class="text-center">Admin Login</h1>
    <div class="adminlogin">
        <form action="{{ url('/admin/login') }}" method="post">
            @csrf
            <table style="margin:0 auto">
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email"/></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="password"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p>Forget Password? <a href="{{ url('admin/forget-password') }}">Click to </a>recover now</p>   <br>
                    </td>

                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="login" value="Login"/></td>
                    
                </tr>
            </table>
        </from>
    </div>
    </div>

@endsection