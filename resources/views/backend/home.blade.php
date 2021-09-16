@extends('backend.layouts.app')
@section('controller','')
@section('controller_route', route('admin.home'))
@section('action','')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Sản phẩm</span>
                        <span class="info-box-number">1 Sản phẩm</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
		                    <a href="#" style="color: #fff">Xem chi tiết</a>
		                </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-blue">
                    <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Bài viết</span>
                        <span class="info-box-number">1 bài viết</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
		                    <a href="#" style="color: #fff">Xem chi tiết</a>
		                </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Đơn hàng</span>
                        <span class="info-box-number">1 đơn hàng</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
		                    <a href="#" style="color: #fff">Xem chi tiết</a>
		                </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Liên hệ</span>
                        <span class="info-box-number">1 liên hệ</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
		                    <a href="#" style="color: #fff">Xem chi tiết</a>
		                </span>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="table-translate">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="30px">STT</th>
                                    <th width="">Tên trang</th>
                                    <th width="">Liên kết</th>
                                </tr>
                                </thead>
                                <tbody class="table-body-pro">
{{--                                @foreach ($dataPages as $item)--}}
                                    <tr>
{{--                                        <td>{{ $loop->index + 1 }}</td>--}}
{{--                                        <td>{{ $item->name_page }}</td>--}}
                                        <td>1</td>
                                        <td>2</td>
                                        <td>
{{--                                            @if (\Route::has($item->route))--}}
{{--                                                <a href="{{ route($item->route) }}" target="_blank">--}}
{{--                                                    <i class="fa fa-hand-o-right" aria-hidden="true"></i>--}}
{{--                                                    Link: {{ route($item->route) }}--}}
{{--                                                </a>--}}
{{--                                            @else--}}
                                                ---------------
{{--                                            @endif--}}
                                        </td>
                                    </tr>
{{--                                @endforeach--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
