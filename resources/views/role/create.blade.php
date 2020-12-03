<form method="POST" action="{{ route('role.store') }}">
    @csrf
    @method('POST')
    <label for="role">Role</label>
    <input id="title" type="role" name="role">
    <br>

    <label for="writer">User can create, edit and delete articles that they own:</label>
    @include('includes.role.create', ['name' => 'writer'])

    <label for="">Can edit any article:</label>
    @include('includes.role.create', ['name' => 'edit_article'])

    <label for="">Can delete any article:</label>
    @include('includes.role.create', ['name' => 'delete_article'])

    <label for="">Can create a new role</label>
    @include('includes.role.create', ['name' => 'create_role'])

    <label for="">Can edit existing roles:</label>
    @include('includes.role.create', ['name' => 'edit_role'])

    <label for="writer">Can delete any role</label>
    @include('includes.role.create', ['name' => 'edit_article'])

    <label for="">Can create a new user</label>
    @include('includes.role.create', ['name' => 'create_user'])

    <label for="">Can edit existing users:</label>
    @include('includes.role.create', ['name' => 'edit_user'])

    <label for="">Can delete any user</label>
    @include('includes.role.create', ['name' => 'delete_user'])

    <button type="submit">
        Save
    </button>
</form>
