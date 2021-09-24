
@extends('layouts.frontend.design')
@section('title','Profile Settings-Semster User')
@section('section')
    <div class="main">
    <h1>Change Password</h1>
    <div class="adminlogin">
        <form action="{{ url('/profile') }}" method="post">
            @csrf
            <table style="margin:0 auto">
                <tr>
                    <td>Old Password</td>
                    <td><input type="password" name="old"/></td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="new"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="submit"/></td>
                    
                </tr>
            </table>
        </from>
    </div>
    </div>

@endsection