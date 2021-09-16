<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td><input type="text" class="form-control" name="content[social_header][{{$id}}][name]" value="{!! @$value->name !!}"></td>
	<td>
        <div class="image">
            <div class="image__thumbnail">
                <img src="{{ !empty($value->image) ? $value->image : __IMAGE_DEFAULT__ }}"  
                data-init="{{ __IMAGE_DEFAULT__ }}">
                <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
                <i class="fa fa-times"></i></a>
                <input type="hidden" value="{{ @$value->image }}" name="content[social_header][{{$id}}][image]"  />
                <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
            </div>
        </div>
    </td>
	<td>
        <input type="text" class="form-control" name="content[social_header][{{$id}}][link]" value="{!! @$value->link !!}">
    </td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>