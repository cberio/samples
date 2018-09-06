@extends('layouts.master')

@section('contents')
    <div class="container">
        <div class="col-md-12">
            <form name="frm" id="frm" method="post" class="form-horizontal">
                {!! csrf_field() !!}

                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <span>name</span>
                        </div>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" placeholder="name" name="name" value="{{ $faker->name }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <span>email</span>
                        </div>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" placeholder="email" name="email" value="{{ $faker->safeEmail }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <span>password</span>
                        </div>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" placeholder="password" name="password" value="000000">
                        </div>
                    </div>
                </div>

                <div class="row">
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
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <span>contact</span>
                        </div>
                        <div class="col-sm-10">
                            <input type="tel" name="contact_number" placeholder="contact_number" class="form-control" value="{{ $faker->regexify('^10([1-9]{4})([1-9]{4})$') }}">
                        </div>
                    </div>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-success">등록</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
    </script>
@endsection