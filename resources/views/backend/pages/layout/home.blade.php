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
				            	<a href="#content-1" data-toggle="tab" aria-expanded="true">Tại sao chọn chúng tôi</a>
							</li>
							<li class="">
				            	<a href="#content-2" data-toggle="tab" aria-expanded="true">Banner sản phẩm nổi bật</a>
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
										<input type="text" class="form-control" name="content[title]" value="{!! @$content->title !!}">
									</div>
                                    <div class="form-group">
										<label for="">Mô tả</label>
                                        <textarea name="content[desc]" class="form-control" rows="5">{!! @$content->desc !!}</textarea>
									</div>
								</div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Nội dung</label>
                                        <div class="repeater" id="repeater">
                                            <table class="table table-bordered table-hover whychoose">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 30px">STT</th>
                                                        <th width="100px">Hình ảnh</th>
                                                        <th>Nội dung</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="sortable">
                                                    @if (!empty($content->whychoose))
                                                        @foreach ($content->whychoose as $key => $value)
                                                            <?php $index = $loop->index + 1 ; ?>
                                                            @include('backend.repeater.row-whychoose')
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                            <div class="text-right">
                                                <button class="btn btn-primary" style="display:none"
                                                    onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'whychoose', '.whychoose')">Thêm
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
			            	</div>
						</div>
			            <div class="tab-pane" id="content-2">
			            	<div class="row">
								<div class="col-sm-12">
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<label for="">Banner</label>
												<div class="image">
													<div class="image__thumbnail">
														<img src="{{ !empty($content->banner) ? $content->banner : __IMAGE_DEFAULT__ }}"
														data-init="{{ __IMAGE_DEFAULT__ }}">
														<a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
															<i class="fa fa-times"></i></a>
														<input type="hidden" value="{{ @$content->banner }}" name="content[banner]" />
														<div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
													</div>
												</div>
											</div>

										</div>
									</div>
								</div>
			            	</div>
						</div>

			           	<button type="submit" id="get" class="btn store-data btn-primary">Lưu lại</button>
			        </div>
				</form>
			</div>
		</div>
	</div>
@stop
