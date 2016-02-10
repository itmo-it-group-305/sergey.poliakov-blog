<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Бложег</title>
</head>
<body>
<?php foreach ($posts as $post): ?>
    <section>
        <header>
            <h2>
                <a href="show.php?id=<?= $post['id'] ?>">
                    <?= $post['title'] ?>
                </a>
            </h2>
        </header>
        <ul>
            <li>Создан <?= date('Y-m-d H:i', $post['created']) ?></li>
            <li>Обновлен <?= date('Y-m-d H:i', $post['updated']) ?></li>
        </ul>
        <p>
            <?= $post['content'] ?>
        </p>
    </section>
<?php endforeach; ?>
</body>
</html>
