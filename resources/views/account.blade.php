@extends('layouts.layout')
@section('title', 'Account')

@section('content')
<div class="bg-white min-vh-100">
    <div class="p-3">
        <h4>
            Account Settings
        </h4>
        <hr>
        <div class="row">
            <div class="col-md-10">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <form action="">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Display Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="displayName">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-custom-submit col-2 offset-10">Change</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <form action="">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Old Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="oldPassword">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">New Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="newPassword">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-custom-submit col-2 offset-10">Change</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
            <div class="col-md-2">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Account</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection