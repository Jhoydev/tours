<div id="roles" class="form-row">

    <input type="hidden" id="url_roles" value="{{ url('user/roles') }}">
    <input type="hidden" id="url_permissions" value="{{ url('user/permissions') }}">
    <input type="hidden" name="permissions_id" :value="checked_permission">
    <input type="hidden" name="rol" id="user_role_id" value="{{ $method == 'PUT' ? $user->Roles->last()->id : '' }}">
    <input type="hidden" id="user_id" value="{{ $method == 'PUT' ? $user->id : '' }}">

    <div class="col-12 mb-3">
        <h5>Rol</h5>
        <div v-for="role in roles" class="form-check">
            <input class="form-check-input" type="radio" name="role_id" v-model="rolepicked" :value="role.id" required>
            <label class="form-check-label" :for="role.slug ">
                <strong class="text-capitalize">@{{ role.name }}</strong>
            </label>
        </div>
    </div>
    <div class="col-12" v-if="rolepicked">
        <h5>Permisos</h5>
        <div v-for="permission in permissions" class="form-check">
            <label class="switch switch-icon switch-pill switch-primary-outline-alt"
                   v-bind:class="{ 'switch-secondary-outline-alt': permission.disabled }" :for="permission.name">
                <input type="checkbox" class="switch-input" :id="permission.name" v-model="permission.checked"
                       :disabled="permission.disabled">
                <span class="switch-label" data-on="&#10004" data-off="&#10006"></span>
                <span class="switch-handle"></span>
            </label>
            <span>@{{ permission.description }}</span>
        </div>
    </div>
</div>