<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zerostudios Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style2.css'); ?>">
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="card-form signup-form">
                <form action="<?php echo base_url('login/aksi_reg'); ?>" method="post">
                    <div class="form-group">
                        <input id="Nama" name="nama" type="text" class="form-control" placeholder="Nama" required />
                    </div>
                    <div class="form-group">
                        <input id="Email" name="email" type="text" class="form-control" placeholder="Email" required />
                    </div>
                    <div class="form-group">
                        <input id="Username" name="username" type="text" class="form-control" placeholder="Username" required />
                    </div>
                    <div class="form-group">
                        <input id="reg-password" name="password" type="password" class="form-control" placeholder="Password" required />
                        <span toggle="#reg-password" id="toggle-reg-password" class="eye-icon fas fa-fw fa-eye toggle-password"></span>
                    </div>
                    <div class="form-group">
                        <input id="reg-password2" name="password2" type="password" class="form-control" placeholder="Ulangi Password" required />
                        <span toggle="#reg-password2" id="toggle-reg-password2" class="eye-icon fas fa-fw fa-eye toggle-password"></span>
                    </div>
                    <button type="submit" class="btn gradient-custom">Daftar</button>
                </form>
            </div>
            <div class="card-form signin-form">
                <form action="<?php echo base_url('login/aksi') ?>" method="post">
                    <div class="form-group">
                        <input id="Username" name="username" type="text" class="form-control" placeholder="Username" required />
                    </div>
                    <div class="form-group">
                        <input id="password" name="password" type="password" class="form-control" placeholder="Password" required />
                        <span toggle="#password" id="toggle-password" class="eye-icon fas fa-fw fa-eye  toggle-password"></span>
                    </div>
                    <button type="submit" class="btn gradient-custom">
                        Login
                    </button>
                </form>
                <hr>
                <div class="form-group d-md-flex" style="margin-top: 20px;">
                    <div class="w-50">
                        <label class="checkbox-wrap checkbox-primary">Remember Me
                            <input type="checkbox" checked />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="w-50 text-md-end">
                        <a href="#" style="color: #fff">Forgot Password</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="intros-container">
            <div class="intro-control signin-intro ">
                <div class="intro-control__inner">
                    <h2>Welcome back!</h2>
                    <p>
                        Welcome back! We are so happy to have you here. It's great to see
                        you again. We hope you had a safe and enjoyable time away.
                    </p>
                    <button id="signup-btn" class="btn gradient-custom">No account yet? Signup.</button>
                </div>
            </div>
            <div class="intro-control signup-intro ">
                <div class="intro-control__inner">
                    <h2>Come join us!</h2>
                    <p>
                        We are so excited to have you here.If you haven't already, create
                        an account to get access to exclusive offers, rewards, and
                        discounts.
                    </p>
                    <button id="signin-btn" class="btn gradient-custom">Already have an account? Signin.</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/main2.js'); ?>"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".toggle-password").forEach(function(toggle) {
                toggle.addEventListener("click", function() {
                    var field = document.querySelector(this.getAttribute("toggle"));
                    if (!field) return;
                    field.type = (field.type === "password") ? "text" : "password";
                    this.classList.toggle("fa-eye");
                    this.classList.toggle("fa-eye-slash");
                });
            });
        });
    </script>
</body>
