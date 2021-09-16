@extends('backend.layouts.app')
@section('controller','Trang')
@section('controller_route',route('pages.list'))
@section('action','Danh sách')
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
               	<form action="{{ route('pages.build.post') }}" method="POST">
					{{ csrf_field() }}
					<input name="type" value="{{ $data->type }}" type="hidden">

	               	<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">Trang</label>
								<input type="text" class="form-control" value="{{ $data->name_page }}" disabled="">

								@if (\Route::has($data->route))
									<h5>
										<a href="{{ route($data->route) }}" target="_blank">
					                        <i class="fa fa-hand-o-right" aria-hidden="true"></i>
					                        Link: {{ route($data->route) }}
					                    </a>
									</h5>
				                @endif
							</div>

						</div>
					</div>
					<div class="nav-tabs-custom">
				        <ul class="nav nav-tabs">
                            <li class="active">
				            	<a href="#content-1" data-toggle="tab" aria-expanded="true">Về chúng tối</a>
				            </li>
				            <li class="">
				            	<a href="#content-2" data-toggle="tab" aria-expanded="true">Tầm nhìn</a>
				            </li>
							<li class="">
				            	<a href="#content-3" data-toggle="tab" aria-expanded="true">Sứ mệnh</a>
				            </li>
							<li class="">
				            	<a href="#content-4" data-toggle="tab" aria-expanded="true">Giá trị cốt lõi</a>
				            </li>
							<li class="">
				            	<a href="#content-5" data-toggle="tab" aria-expanded="true">Đội ngũ sáng lập</a>
				            </li>
							<li class="">
				            	<a href="#seo" data-toggle="tab" aria-expanded="true">Cấu hình trang</a>
				            </li>
				        </ul>
					</div>
					<?php if(!empty($data->content)){
						$content = json_decode($data->content);
					} ?>
				    <div class="tab-content">
                        <div class="tab-pane active" id="content-1">
							<div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Tiêu đề</label>
                                        <input type="text" name="content[title]" class="form-control" value="{{ @$content->title }}">
                                    </div>
                                </div>
								<div class="col-sm-2">
									<div class="form-group">
										<label for="">Hình ảnh</label>
										<div class="image">
											<div class="image__thumbnail">
											<img src="{{ !empty($content->about_us->image) ? $content->about_us->image : __IMAGE_DEFAULT__ }}"
											data-init="{{ __IMAGE_DEFAULT__ }}">
											<a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
												<i class="fa fa-times"></i></a>
											<input type="hidden" value="{{ @$content->about_us->image }}" name="content[about_us][image]" />
											<div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-10">
									<div class="form-group">
										<label for="">Tiêu đề</label>
										<input type="text" name="content[about_us][title]" class="form-control" value="{{ @$content->about_us->title }}">
									</div>
									<div class="form-group">
										<label for="">Nội dung</label>
										<textarea name="content[about_us][content]" class="content">{!! @$content->about_us->content !!}</textarea>
									</div>
                                    <div class="form-group">
										<label for="">iframe</label>
										<textarea name="content[about_us][iframe]" class="form-control" rows="5">{!! @$content->about_us->iframe !!}</textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="content-2">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="">Nội dung</label>
										<textarea name="content[vision][content]" class="content">{!! @$content->vision->content !!}</textarea>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="content-3">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="">Nội dung</label>
										<textarea name="content[mission][content]" class="content">{!! @$content->mission->content !!}</textarea>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="content-4">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="">Nội dung</label>
										<textarea name="content[core_value][content]" class="content">{!! @$content->core_value->content !!}</textarea>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="content-5">
							<div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Mô tả</label>
                                        <textarea name="content[team][desc]" class="form-control" rows="5">{{ @$content->team->desc }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nội dung</label>
                                        <div class="repeater" id="repeater">
                                            <table class="table table-bordered table-hover team">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 30px">STT</th>
                                                        <th width="100px">Hình ảnh</th>
                                                        <th>Nội dung</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="sortable">
                                                    @if (!empty($content->team->list))
                                                        @foreach ($content->team->list as $key => $value)
                                                            <?php $index = $loop->index + 1 ; ?>
                                                            @include('backend.repeater.row-team')
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                            <div class="text-right">
                                                <button class="btn btn-primary"
                                                    onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'team', '.team')">Thêm
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div>
						</div>

						<div class="tab-pane" id="seo">
							<div class="row">
								<div class="col-sm-2">
									<div class="form-group">
			                           <label>Hình ảnh</label>
			                           <div class="image">
			                               <div class="image__thumbnail">
			                                   <img src="{{ $data->image ?  $data->image : __IMAGE_DEFAULT__ }}"
			                                   data-init="{{ __IMAGE_DEFAULT__ }}">
			                                   <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
			                                    <i class="fa fa-times"></i></a>
			                                   <input type="hidden" value="{{ @$data->image }}" name="image"  />
			                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
			                               </div>
			                           </div>
			                       </div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
			                           <label>Banner</label>
			                           <div class="image">
			                               <div class="image__thumbnail">
			                                   <img src="{{ $data->banner ?  $data->banner : __IMAGE_DEFAULT__ }}"
			                                   data-init="{{ __IMAGE_DEFAULT__ }}">
			                                   <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
			                                    <i class="fa fa-times"></i></a>
			                                   <input type="hidden" value="{{ @$data->banner }}" name="banner"  />
			                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
			                               </div>
			                           </div>
			                       </div>
								</div>
								<div class="col-sm-8">
									<div class="form-group">
										<label for="">Tiêu đề trang</label>
										<input type="text" name="meta_title" class="form-control" value="{{ @$data->meta_title }}">
									</div>
									<div class="form-group">
										<label for="">Mô tả trang</label>
										<textarea name="meta_description"
										class="form-control" rows="5">{!! @$data->meta_description !!}</textarea>
									</div>
									<div class="form-group">
										<label for="">Từ khóa</label>
										<input type="text" name="meta_keyword" class="form-control" value="{!! @$data->meta_keyword !!}">
									</div>
								</div>
							</div>
			            </div>
			           <button type="submit" class="btn btn-primary">Lưu lại</button>
			        </div>
				</form>
			</div>
		</div>
	</div>
@stop
