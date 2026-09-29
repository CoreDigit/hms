@if ($errors->any())
    <div class="alert alert-solid-danger mg-b-4" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ $errors->first() }}
    </div>
@endif

<!---------------------------------------------------------------------------->

@if (session('created'))
    <div class="alert alert-outline-success" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button> {{ session('created') }}
    </div>
@endif

@if (session('updated'))
    <div class="alert alert-outline-success" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button> {{ session('updated') }}
    </div>
@endif

@if (session('deleted'))
    <div class="alert alert-outline-warning" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button> {{ session('deleted') }}
    </div>
@endif

@if (session('activated'))
    <div class="alert alert-outline-warning" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button> {{ session('activated') }}
    </div>
@endif

@if (session('inactivated'))
    <div class="alert alert-outline-warning" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button> {{ session('inactivated') }}
    </div>
@endif

@if (session('password'))
    <div class="alert alert-outline-success" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button> {{ session('password') }}
    </div>
@endif

<!---------------------------------------------------------------------------->

@if (session('create_error'))
    <div class="alert alert-outline-danger" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button> {{ session('create_error') }}
    </div>
@endif

@if (session('update_error'))
    <div class="alert alert-outline-danger" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button> {{ session('update_error') }}
    </div>
@endif

@if (session('delete_error'))
    <div class="alert alert-outline-danger" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button> {{ session('delete_error') }}
    </div>
@endif

@if (session('activate-error'))
    <div class="alert alert-outline-danger" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button> {{ session('activate-error') }}
    </div>
@endif

@if (session('inactivate-error'))
    <div class="alert alert-outline-danger" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button> {{ session('inactivate-error') }}
    </div>
@endif

@if (session('password_error'))
    <div class="alert alert-outline-danger" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button> {{ session('password_error') }}
    </div>
@endif

