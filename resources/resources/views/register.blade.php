<?php 
use App\Contents; 
use App\User; 
$title = _("Register");
$description = _("Register This Page");
$keywords = "register,create new account";

?>

@extends('layouts.app')

@section("title",$title)
@section("description",$description)
@section("keywords",$keywords)


@section('content')


    <div class="container bg-white " style="padding-top:20px;">
    <div id="login-row" class="row justify-content-center align-items-center pb-4">
   
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                    
                        <form id="login-form" class="form" action="?create" method="post">
                        {{csrf_field()}}
                            <h3 class="text-center text-primary">{{e2("Register")}}</h3>
                            <?php if(getisset("create")) {
                                $varmi = db("users")->where("email",post("email"))->orWhere("phone",post("phone"))->first();
                                if($varmi) {
                                    alert("This e-mail address or phone number is already registered in our system.");
                                } else {
                                    $user = new User;
                                    $user->country = post("country");
                                    $user->name = post("name");
                                    $user->surname = post("surname");
                                    $user->email = post("email");
                                    $user->phone = post("phone");
                                    $user->level = "Member";
                                    $user->password = kripto(post("password"));
                                    $user->recover = post("password");
                                    $user->save();
                                    $kim = db("users")->where("email",post("email"))->first();
                                    oturum("uid",$kim->id);
                                    $_SESSION['user'] = $kim;
                                    mailtemp(post("email"),"Create Account",array(
                                        "name" => post("name"),
                                        "surname" => post("surname"),
                                        "password" => post("password")
                                    ));
                                    yonlendir("profile");
                                }
                            } ?>
                            <div class="form-group">
                                <label for="country" class="text-primary">{{e2("Country")}}:</label><br>
                                <select name="country" required id="" class="form-control">
                                
                                    <option value="">{{e2("Select Country")}}</option>
                                    <?php foreach(countries() AS $c) {
                                         ?><option value="{{$c}}">{{$c}}</option>
                                         <?php 
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name" class="text-primary">{{e2("First Name")}}:</label><br>
                                <input type="text" required name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="surname" class="text-primary">{{e2("Surname")}}:</label><br>
                                <input type="text" required name="surname" id="surname" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="username" class="text-primary">{{e2("E-Mail")}}:</label><br>
                                <input type="text" required name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="username" class="text-primary">{{e2("Phone")}}:</label><br>
                                <input type="text" required name="phone" id="phone" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-primary">{{e2("Password")}}:</label><br>
                                <input type="password" required name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">{{e2("Submit")}}</button>
                                
                            </div>
                            <div class="text-right"><a href="login">{{e2("Sign In")}}</a></div>
                        </form>
                    </div>
                </div>
            </div>
           
    </div>
        


    

@endsection

