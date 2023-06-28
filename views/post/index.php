<?php if (!empty($data['posts'])) { ?>
    <h2>Here is a list of all posts:</h2>

    <?php foreach ($data['posts'] as $post) { ?>
        <div>
            <hr/>
            <p>Post Id: <?php echo $post->id; ?></p>
            <p>Post Text: <?php echo $post->text; ?></p>
            <hr/>
        </div>
    <?php } ?>
    <br><br>
<?php } ?>

<p>Each new post will be sent by email and SMS</p>
<form id="storePostForm" method="post" action="/post/store">
    <textarea name="postText" required></textarea>
    <input type="hidden" name="csrfToken" value="<?= $data['csrfToken'] ?>"/>
    <br><br>
    <input type="submit" value="Go!"/>
</form>


