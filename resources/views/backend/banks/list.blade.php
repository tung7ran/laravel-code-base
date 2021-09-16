@extends('backend.layouts.app')
@section('controller', $module['name'] )
@section('controller_route', route($module['module'].'.index'))
@section('action', 'Danh sách')
@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form action="" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="btnAdd">
                        <a href="{{ route($module['module'].'.create') }}">
                            <fa class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</fa>
                        </a>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn xóa không ?')">
                            <i class="fa fa-trash-o"></i> Xóa
                        </button>
                    </div>
                    @include('backend.layouts.components.table')
                </form>
            </div>
        </div>
    </div>
@stop
