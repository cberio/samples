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
                    <h3 class="box-title">사용자 생성</h3>
                </div>

                <form name="frm" id="frm" method="post" class="form-horizontal">
                    {!! csrf_field() !!}

                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-2">
                                <span>name</span>
                            </div>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="name" name="name" value="{{ $faker->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">
                                <span>email</span>
                            </div>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="email" name="email" value="{{ $faker->safeEmail }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">
                                <span>password</span>
                            </div>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" placeholder="password" name="password" value="000000">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">
                                <span>device_type</span>
                            </div>
                            <div class="col-sm-10">
                                <select class="form-control" name="device_type" id="device_type" title="device_type">
                                    <option value="1">AOS</option>
                                    <option value="4">IOS</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">
                                <span>contact</span>
                            </div>
                            <div class="col-sm-10">
                                <input type="tel" name="contact_number" placeholder="contact_number" class="form-control" value="{{ $faker->regexify('^10([1-9]{4})([1-9]{4})$') }}">
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <a href="{{ route('appLozic.index') }}" class="btn btn-default">취소</a>
                        <button type="submit" class="btn btn-info pull-right">등록</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
    </script>
@endsection
