<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Бложег</title>
</head>
<body>
<?php $flashMessages = flushFlashMessages(); ?>

<?php foreach ($flashMessages as $type => $messages) : ?>
    <div>
        <div class="<?= type ?>">
            <?php foreach ($messages as $text) : ?>
                <p><?= $text ?></p>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>


<form action="" method="post">
    <div>
        <div class="error">
            <?= e($errors, 'title') ?>
        </div>
        <label for="post_title">Заголовок</label>
        <input id="post_title" name="post[title]" type="text" value="<?= e($post, 'title') ?>">
    </div>
    <div>
        <div class="error"><?= e($errors, 'content') ?></div>
        <label for="post_content">Текст записи</label>
        <textarea id="post_content" name="post[content]"><?= e($post, 'content') ?></textarea>
    </div>
    <?php if (isset($post['id'])) :?>
        <div>
            <input type="hidden" name="post[id]" value="<?= e($post, 'id') ?>"
        </div>
    <?php endif; ?>
    <div>
        <input type="submit">
    </div>
</form>
</body>

</html>