@extends('layouts.master')

@section('title', 'QuickBlox')

@section('contents')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Chat-Sample <small>QuickBlox</small></h1>
        </section>

        <section class="content">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">QuickBlox Users</h3>

                    <div class="btn-group pull-right">
                        <a href="{{ route('quickBlox.create') }}" class="btn btn-primary">생성</a>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>full_name</th>
                                <th>email</th>
                                <th>login</th>
                                <th>phone</th>
                                <th>created_at</th>
                                <th>updated_at</th>
                                <th>last_request_at</th>
                                <th>external_user_id</th>
                                <th>custom_data</th>
                                <th>user_tags</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><a href="{{ route('quickBlox.edit', $user->id) }}">{{ $user->id }}</a></td>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->login }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->updated_at }}</td>
                                    <td>{{ $user->last_request_at }}</td>
                                    <td>{{ $user->external_user_id }}</td>
                                    <td>{!! $user->custom_data !!}</td>
                                    <td>
                                        @foreach(explode(',', $user->user_tags) as $tag)
                                            <span class="label label-success">{{ $tag }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="box-footer">
                    {{ $users->links() }}
                </div>
            </div>
        </section>
    </div>
@endsection
