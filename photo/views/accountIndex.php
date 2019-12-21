<div class="card border-light mt-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">account</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?=$this->auth['name']?></li>
        </ol>
    </nav>
    <div class="card-body">
        <p>Name: <b><?=$this->auth['name']?></b></p>
       <a href="/account/changePassword" class="btn btn-success btn-sm">Change password</a>
       <a href="/account/destroy" class="btn btn-danger btn-sm">Delete Account</a>
    </div>
</div>