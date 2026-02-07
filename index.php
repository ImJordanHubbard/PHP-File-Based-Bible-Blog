<?php
require_once __DIR__ . '/config/bootstrap.php';

$page_title = 'Blog - ByteSizeBible';
include BASE_PATH . '/partials/header.php';
include BASE_PATH . '/partials/navigation.php';

$postsDir = __DIR__ . '/posts/';
$posts = glob($postsDir . '*.php') ?: [];

// Load once so we do not include the same file multiple times
$items = [];
foreach ($posts as $file) {
    $p = include $file;

    $slug = $p['slug'] ?? pathinfo($file, PATHINFO_FILENAME);
    $category = strtolower($p['category'] ?? 'uncategorized');

    $contentText = strip_tags($p['content'] ?? '');
    $excerpt = mb_strlen($contentText) > 200 ? mb_substr($contentText, 0, 200) . '...' : $contentText;

    $items[] = [
        'title' => $p['title'] ?? '',
        'slug' => $slug,
        'category' => $category,
        'categoryLabel' => $p['category_label'] ?? ucwords(str_replace('-', ' ', $category)),
        'date' => $p['date'] ?? 0,
        'image' => $p['image'] ?? '/assets/images/blog-post.jpg',
        'scripture' => $p['scripture'] ?? '',
        'book' => strtolower($p['book'] ?? ''),
        'bookLabel' => $p['book_label'] ?? (!empty($p['book']) ? ucwords(str_replace('-', ' ', $p['book'])) : ''),
        'excerpt' => $excerpt,
    ];
}

usort($items, fn($a, $b) => ($b['date'] ?? 0) <=> ($a['date'] ?? 0));
?>

<main>
  <div class="blog-header">
    <h2>All Posts</h2>
    <div class="blog-divider"></div>
  </div>

  <div class="blog-filters">
    <select id="category-filter">
      <option value="all">All Categories</option>
      <option value="law">Law</option>
      <option value="history">History</option>
      <option value="wisdom-poetry">Wisdom &amp; Poetry</option>
      <option value="prophets">Prophets</option>
      <option value="apocalyptic-revelation">Apocalyptic &amp; Revelation</option>
      <option value="gospels">Gospels</option>
      <option value="pauline-epistles">Pauline Epistles</option>
      <option value="general-epistles">General Epistles</option>
    </select>

    <select id="book-filter" aria-label="Filter by Bible book">
      <option value="all">All Books</option>
      <optgroup label="New Testament">
        <option value="matthew">Matthew</option>
        <option value="mark">Mark</option>
        <option value="luke">Luke</option>
        <option value="john">John</option>
        <option value="acts">Acts</option>
        <option value="romans">Romans</option>
        <option value="1-corinthians">1 Corinthians</option>
        <option value="2-corinthians">2 Corinthians</option>
        <option value="galatians">Galatians</option>
        <option value="ephesians">Ephesians</option>
        <option value="philippians">Philippians</option>
        <option value="colossians">Colossians</option>
        <option value="1-thessalonians">1 Thessalonians</option>
        <option value="2-thessalonians">2 Thessalonians</option>
        <option value="1-timothy">1 Timothy</option>
        <option value="2-timothy">2 Timothy</option>
        <option value="titus">Titus</option>
        <option value="philemon">Philemon</option>
        <option value="hebrews">Hebrews</option>
        <option value="james">James</option>
        <option value="1-peter">1 Peter</option>
        <option value="2-peter">2 Peter</option>
        <option value="1-john">1 John</option>
        <option value="2-john">2 John</option>
        <option value="3-john">3 John</option>
        <option value="jude">Jude</option>
        <option value="revelation">Revelation</option>
      </optgroup>
    </select>
  </div>

  <div class="blog-container all-posts-section">
    <?php foreach ($items as $p): ?>
      <?php $url = '/' . $p['category'] . '/' . $p['slug']; ?>

      <a href="<?= htmlspecialchars($url) ?>"
         class="blog-card"
         data-category="<?= htmlspecialchars($p['category']) ?>"
         data-book="<?= htmlspecialchars($p['book']) ?>">

        <?php if (!empty($p['image'])): ?>
          <img src="<?= htmlspecialchars($p['image']) ?>"
               alt="<?= htmlspecialchars($p['title']) ?>"
               class="blog-image">
        <?php endif; ?>

        <div class="blog-content">
          <p class="blog-category"><?= htmlspecialchars($p['categoryLabel']) ?></p>

          <?php if (!empty($p['bookLabel'])): ?>
            <span class="blog-book"><?= htmlspecialchars($p['bookLabel']) ?></span>
          <?php endif; ?>

          <h3 class="blog-title"><?= htmlspecialchars($p['title']) ?></h3>

          <?php if (!empty($p['scripture'])): ?>
            <span class="blog-scripture"><?= htmlspecialchars($p['scripture']) ?></span>
          <?php endif; ?>

          <p class="blog-description"><?= htmlspecialchars($p['excerpt']) ?></p>
          <p class="blog-date"><?= $p['date'] ? date('j M Y', (int) $p['date']) : '' ?></p>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
</main>

<?php include BASE_PATH . '/partials/footer.php'; ?>
