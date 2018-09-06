@extends('layouts.master')

@section('title', 'AppLozic')

@section('contents')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Chat-Sample <small>AppLozic</small></h1>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">AppLozic Users</h3>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>email</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <a href="{{ route('appLozic.edit', $user->id) }}">보기</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="box-footer">
                    <form name="frm" id="frm" method="post">
                        {!! csrf_field() !!}

                        <div class="btn-group pull-right">
                            <a class="btn btn-primary" href="{{route('appLozic.create')}}">생성</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
    </script>
@endsection
