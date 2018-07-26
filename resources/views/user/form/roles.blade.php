<div class="form-row px-5">
    <input type="hidden" id="url_permissions" value="{{ url('user/permissions') }}">
    <input type="hidden" id="permissions" value="{{ $permissions }}">
    <input type="hidden" id="list_roles" value="{{ $roles }}">
    <input type="hidden" name="" id="user_role_id" value="{{ $method == 'PUT' ? $user_role : '' }}">
    <input type="hidden" id="user_id" value="{{ $method == 'PUT' ? $user->id : '' }}">
    <input type="hidden" name="permissions_id" v-model="checked_permissions">
    <div class="col-12 mb-2">
        <h4 class="text-center"><span class="fa fa-shield"></span> Roles</h4>
    </div>
    <div class="col-12 d-flex justify-content-between">
        <div v-for="role in roles" class="mb-2">
            <label class="switch switch-icon switch-pill switch-primary-outline-alt">
                <input type="radio" class="switch-input" name="role_id"
                       v-model="rolepicked" :value="role.id" v-on:change="getPermissions" required>
                <span class="switch-label" data-on="&#10004" data-off="&#10006"></span>
                <span class="switch-handle"></span>
            </label>
            <span>@{{ role.name }}</span>
        </div>
    </div>
    <div class="col-12" v-if="rolepicked">
        <hr>
        <h4 class="text-center"><span class="fa fa-flag"></span> Permisos <span v-show="show_permissions" class="text-center"><i class="fa fa-spinner fa-pulse" arial-hidden="true"></i><span class="sr-only">Refreshing...</span></span></h4>

        <div v-for="permission in permissions">
            <label class="switch switch-icon switch-pill switch-primary-outline-alt"
                   v-bind:class="{ 'switch-secondary-outline-alt': permission.disabled }">
                <input type="checkbox" class="switch-input" v-on:change="setInputChecked" v-model="permission.checked"
                       :disabled="permission.disabled">
                <span class="switch-label" data-on="&#10004" data-off="&#10006"></span>
                <span class="switch-handle"></span>
            </label>
            <span>@{{ permission.name }}</span>
        </div>
    </div>
</div>