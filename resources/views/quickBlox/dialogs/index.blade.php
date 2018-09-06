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
                    <h3 class="box-title">QuickBlox Dialogs</h3>

                    <div class="btn-group pull-right">
                        <a href="" class="btn btn-primary">생성</a>
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

                        </tbody>
                    </table>
                </div>

                <div class="box-footer">

                </div>
            </div>
        </section>
    </div>
@endsection
