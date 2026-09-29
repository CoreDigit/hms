@extends('users.admin.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="content-title mb-0 my-auto">Role-Based Access Control (RBAC) Matrix</h4>
    </div>
    <div class="d-flex my-xl-auto right-content">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addRoleModal"><i class="fa fa-user-shield"></i> Create New Role</button>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
    @foreach($roles as $role)
        <div class="col-md-6 mb-4">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $role->label }} ({{ $role->name }})</h5>
                    <span class="badge badge-light text-dark">{{ $role->permissions->count() }} Permissions</span>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.permissions.update', $role->id) }}" method="POST">
                        @csrf
                        <div class="accordion" id="permAccordion{{ $role->id }}">
                            @foreach($permissions as $module => $modulePerms)
                                <div class="card mb-2 border">
                                    <div class="card-header p-2 bg-light" id="heading{{ $role->id }}_{{ Str::slug($module) }}">
                                        <h6 class="mb-0 text-capitalize">
                                            <a class="text-dark" data-toggle="collapse" href="#collapse{{ $role->id }}_{{ Str::slug($module) }}">
                                                <i class="fa fa-folder mr-1"></i> {{ str_replace('_', ' ', $module) }} Module ({{ count($modulePerms) }})
                                            </a>
                                        </h6>
                                    </div>
                                    <div id="collapse{{ $role->id }}_{{ Str::slug($module) }}" class="collapse show" data-parent="#permAccordion{{ $role->id }}">
                                        <div class="card-body p-2">
                                            <div class="row">
                                                @foreach($modulePerms as $perm)
                                                    <div class="col-6 mb-1">
                                                        <label class="ckbox">
                                                            <input type="checkbox" name="permissions[]" value="{{ $perm->id }}"
                                                                {{ $role->permissions->contains($perm->id) ? 'checked' : '' }}>
                                                            <span>{{ $perm->label }}</span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-3"><i class="fa fa-save"></i> Save Permissions Matrix for {{ $role->label }}</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('roles.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header"><h5 class="modal-title">Create Custom Role</h5></div>
            <div class="modal-body">
                <div class="form-group mb-2">
                    <label>Role Key Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required placeholder="e.g. senior_surgeon">
                </div>
                <div class="form-group mb-2">
                    <label>Role Label <span class="text-danger">*</span></label>
                    <input type="text" name="label" class="form-control" required placeholder="e.g. Senior Surgeon">
                </div>
                <div class="form-group mb-2">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Create Role</button>
            </div>
        </form>
    </div>
</div>
@endsection
