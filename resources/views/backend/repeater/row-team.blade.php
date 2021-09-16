<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td>
		<div class="form-group">
			<label for="">Hình ảnh</label>
			<div class="image">
	           	<div class="image__thumbnail">
	               <img src="{{ !empty($value->image) ? $value->image : __IMAGE_DEFAULT__ }}"
	               data-init="{{ __IMAGE_DEFAULT__ }}">
	               <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
	                <i class="fa fa-times"></i></a>
	               <input type="hidden" value="{{ @$value->image }}" name="content[team][list][{{ $key }}][image]"  />
	               <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
	           	</div>
	       	</div>
		</div>
	</td>
	<td>
		<div class="form-group">
			<label for="">Họ tên</label>
			<input type="text" name="content[team][list][{{ $key }}][title]" class="form-control" value="{{ @$value->title }}">
        </div>

		<div class="form-group">
			<label for="">Chức vụ</label>
			<input type="text" name="content[team][list][{{ $key }}][position]" class="form-control" value="{{ @$value->position }}">
        </div>
        <div class="form-group">
            <label for="">Nội dung</label>
            <textarea name="content[team][list][{{ $key }}][content]" id="content{{ $key }}">{!! @$value->content !!}</textarea>
		</div>
	</td>
	<td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>
<script>
	CKEDITOR.replace( 'content{{ $key }}' );
</script>
