<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td>
		<input type="text" class="form-control" name="content[address][list][{{ $id }}][title]" value="{{ @$value->title }}">
	</td>
	<td>
		<textarea name="content[address][list][{{ $id }}][google_map]" rows="3" class="form-control">{!! @$value->google_map !!}</textarea>
	</td>
	<td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>