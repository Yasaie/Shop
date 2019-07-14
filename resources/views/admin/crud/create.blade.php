@extends('admin.layout')

@section('title', $title)

@section('body')
    <form action="">
        @if(isset($multilang))
            <div class="row">
                <div class="col-12">

                    <div class="card">

                        <div class="card-header" style="border-bottom: none">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                @php($langs = config('global.langs'))
                                @foreach($langs as $lang)
                                    <li class="nav-item">
                                        <a class="nav-link {{current($langs) == $lang ? 'active' : ''}}"
                                           data-toggle="tab"
                                           href="#{{$lang->getId()}}-tab"
                                           aria-selected="true">{{$lang->getNativeName()}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content">
                                @foreach($langs as $lang)
                                    <div class="tab-pane fade {{current($langs) == $lang ? 'show active' : ''}}"
                                         id="{{$lang->getId()}}-tab">
                                        @foreach($multilang as $input)
                                            <div class="form-group">
                                                <label for="{{$input['name']}}[{{$lang->getId()}}]">@lang('model.'. $input['name'])</label>
                                                @if(isset($input['value']))
                                                @php($input['value'] = $input['value']->getTranslate($input['name'], $lang->getId()))
                                                @endif
                                                @php($input['name'] = $input['name'] . '[' . $lang->getId() . ']')
                                                @include('admin.crud.inc.' . $input['type'], $input)
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="card-body">
                        @foreach($inputs as $input)
                            <div class="form-group">
                                <label for="{{$input['name']}}">@lang('model.'. $input['name'])</label>
                                @include('admin.crud.inc.' . $input['type'], $input)
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ذخیره</button>
                        <a href="{{url()->previous()}}" class="btn btn-default float-left">بازگشت</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.min.css')}}">
    <link href="http://ticket.ttbz.ir/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
@endsection

@section('script')
    <script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/i18n/' . app()->getLocale() . '.js')}}"></script>
    <script src="{{asset('assets/plugins/tinymce/tinymce.min.js')}}"></script>
    <script>
        $('.select2').select2({
            dir: '{{isRTL(0)}}',
            language: '{{app()->getLocale()}}',
        });
        tinymce.init({
            selector:'textarea.text-html',
            height: 300,
            theme: "modern",
            plugins: [
                "autolink link image lists charmap print hr anchor spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | print | forecolor backcolor",
            content_css: '{{asset('assets/admin/css/tinymce-reset.css')}}',
            directionality : '{{isRTL(0)}}',
            language: '{{app()->getLocale()}}',
        });
    </script>
@endsection