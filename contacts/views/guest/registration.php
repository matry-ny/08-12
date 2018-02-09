<div class="row">
    <div class="col-lg-12">
        <form action="<?= toUrl('guest/createAccount') ?>" method="post">
            <input type="text" name="login" placeholder="Enter your login" class="form-control mb-2">
            <input type="password" name="password" placeholder="Enter your password" class="form-control mb-2">
            <input type="password" name="repeat_password" placeholder="Repeat your password" class="form-control mb-2">

            <input type="submit" value="Registration" class="btn btn-success">
        </form>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <a href="<?= toUrl('guest/login') ?>">I have an account</a>
    </div>
</div>
<br>