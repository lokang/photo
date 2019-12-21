<div class="card mt-2 border-light">
    <div class="card-body">
        <p>Contact us</p>
        <?=$this->errors(); ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="please enter email" value="<?=$this->value('email'); ?>" required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" name="message" id="message" placeholder="Please enter message" required><?=$this->value('message'); ?></textarea>
            </div>
            <div class="form-group">
                <label for="captcha">Captcha</label>
                <strong><?=$_SESSION['random'] ?></strong>
                <input type="text" class="form-control" name="captcha" id="captcha" placeholder="Enter the number above" required>
            </div>
            <button class="btn btn-secondary" type="submit">Send</button>
        </form>
    </div>
</div>