<?php include __DIR__ . '/../header.php'; ?>
<?php foreach ($articles as $article): ?>
    <h2><a href="/articles/<?= $article->getId() ?>"><?= $article->getName() ?></a></h2>
    <p><?= $article->getText() ?></p>
    <a href="/admin/articles/<?= $article->getId() ?>/delete"><button>Удалить</button></a>
    <hr>
<?php endforeach; ?>
    <a href="/admin"><button>Домой</button></a>
<?php include __DIR__ . '/../footer.php'; ?>