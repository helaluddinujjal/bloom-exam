@extends('layouts.frontend.design')
@section('title','Forget Password-Semster ')
@section('section')
    <div class="main">
        <h1>Semster Exam System - Forget Password</h1>
        <div class="segment" style="margin-right:30px;">
            <img src="{{ asset('assets/frontend/img/test.png') }}"/>
        </div>
        <div class="segment">
        <form action="{{ url('/admin/forget-password') }}" method="post">
            @csrf
            <table class="tbl">
                <tr>
                <td>Email</td>
                <td><input name="email" type="text"></td>
                </tr>

                <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Submit">
                </td>
                </tr>
        </table>
        </form>
        </div>
    </div>

@endsection