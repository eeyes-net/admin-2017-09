<?php
$permissions = \App\Model\Eeyes\Permission\Permission::all();
$item_permission_ids = $is_update ? $item->permissions()->pluck('id')->toArray() : [];
?>
@foreach($permissions as $permission)
    <div class="form-check">
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="permissions[]" value="{{ $permission->id }}" @if($is_update && in_array($permission->id, $item_permission_ids)) checked @endif>
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">{{ $permission->name }}</span>
        </label>
    </div>
@endforeach
