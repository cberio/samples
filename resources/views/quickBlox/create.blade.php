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
                    <h3 class="box-title">사용자 생성</h3>
                </div>

                <form class="form-horizontal" method="post">
                    {!! csrf_field() !!}

                    <div class="box-body">
                        <div class="form-group">
                            <label for="user_name" class="col-sm-2">name</label>
                            <div class="col-sm-10">
                                <input type="text" name="user_name" id="user_name" class="form-control" value="{{ $faker->firstName }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2">password</label>
                            <div class="col-sm-10">
                                <input type="text" name="password" id="password" class="form-control" value="00000000">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="full_name" class="col-sm-2">full name</label>
                            <div class="col-sm-10">
                                <input type="text" name="full_name" id="full_name" class="form-control" value="{{ $faker->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-sm-2">phone</label>
                            <div class="col-sm-10">
                                <input type="tel" name="phone" id="phone" class="form-control" value="{{ $faker->regexify('^10([1-9]{4})([1-9]{4})$') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tags" class="col-sm-2">tags</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="tags[]" id="tags" multiple="multiple">
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <a href="{{ route('quickBlox.index') }}" class="btn btn-default">취소</a>
                        <button type="submit" class="btn btn-info pull-right">등록</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#tags").select2({
                allowClear: true,
                maximumSelectionLength: 10,
                minimumInputLength: 3,
                maximumInputLength: 15,
                lang: 'ko',
                tags: true,
                tokenSeparators: [',', ' ']
            });
        });
    </script>
@endsection
