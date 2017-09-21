<?php
$roles = \App\Model\Eeyes\Permission\Role::all();
if ($is_update) {
    if ($item instanceof \App\Model\Eeyes\Permission\Role) {
        $item_role_ids = $item->extend_roles()->pluck('id')->toArray();
    } else {
        $item_role_ids = $item->roles()->pluck('id')->toArray();
    }
} else {
    $item_role_ids = [];
}
?>
@foreach($roles as $role)
    <div class="form-check">
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="roles[]" value="{{ $role->id }}" @if($is_update && in_array($role->id, $item_role_ids)) checked @endif>
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">{{ $role->name }}</span>
        </label>
    </div>
@endforeach
