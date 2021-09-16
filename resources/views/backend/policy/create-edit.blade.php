@extends('backend.layouts.app')
@section('controller', $module['name'] )
@section('controller_route', route($module['module'].'.index'))
@section('action', renderAction(@$module['action']))
@section('content')
	<div class="content">
		<div class="clearfix"></div>
       	@include('flash::message')
       	<form action="{!! updateOrStoreRouteRender( @$module['action'], $module['module'], @$data) !!}" method="POST">
			@csrf
			@if(isUpdate(@$module['action']))
		        {{ method_field('put') }}
		    @endif
			<div class="row">
                <div class="col-sm-12">
					<div class="nav-tabs-custom">
		                <ul class="nav nav-tabs">
		                    <li class="active">
		                        <a href="#activity" data-toggle="tab" aria-expanded="true">Nội dung</a>
							</li>
		                </ul>
		                <div class="tab-content">

		                    <div class="tab-pane active" id="activity">
		                    	<div class="row">
                                    <div class="col-sm-12">
										<div class="form-group">
											<label for="">Tên chính sách</label>
											<input type="text" name="name" class="form-control" value="{{ old('name', @$data->name) }}">
										</div>
										<div class="form-group">
											<label for="">Nội dung</label>
											<textarea name="content" class="content">{!! old('content', @$data->content) !!}</textarea>
										</div>
										<div class="form-group">
											<label class="custom-checkbox">
												@if(isUpdate(@$module['action']))
													<input type="checkbox" name="status" value="1" {{ @$data->status == 1 ? 'checked' : null }}> Hiển thị
												@else
													<input type="checkbox" name="status" value="1" checked> Hiển thị
												@endif
											</label>
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại </button>
										</div>
									</div>
		                    	</div>
							</div>
		                </div>
		            </div>
				</div>
			</div>
		</form>
	</div>

@stop

