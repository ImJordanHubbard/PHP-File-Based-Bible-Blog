<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Get category and slug from URL (via .htaccess rewrite)
$category = $_GET['category'] ?? '';
$slug = $_GET['slug'] ?? '';

// Canonicalise to lowercase, redirect if request is not canonical
$canonicalCategory = strtolower($category);
$canonicalSlug = strtolower($slug);

if ($category !== $canonicalCategory || $slug !== $canonicalSlug) {
    header('Location: /' . $canonicalCategory . '/' . $canonicalSlug, true, 301);
    exit;
}

$postsFolder = __DIR__ . '/posts';
$files = glob($postsFolder . '/*.php');

$post = null;

// Loop through all post files to find matching category + slug
foreach ($files as $file) {
    $postData = include $file;

    $postSlug = strtolower($postData['slug'] ?? pathinfo($file, PATHINFO_FILENAME));
    $postCategory = strtolower($postData['category'] ?? '');

    if ($postSlug === $canonicalSlug && $postCategory === $canonicalCategory) {
        $post = $postData;
        break;
    }
}

if (!$post) {
    http_response_code(404);
    echo "<h1>Post not found</h1>";
    echo "<p>Looking for: " . htmlspecialchars($canonicalCategory . '/' . $canonicalSlug) . "</p>";
    exit;
}

// Post found, set variables for template
$title = $post['title'] ?? 'Untitled';
$content = $post['content'] ?? '';
$postCategory = $post['category'] ?? 'uncategorized';

$book = $post['book'] ?? '';
$bookLabel = $post['book_label'] ?? ($book ? ucfirst(str_replace('-', ' ', $book)) : '');

$scripture = $post['scripture'] ?? '';

// Keep image paths consistent: your posts already use root-relative paths like /assets/...
$image = $post['image'] ?? '/assets/images/blog-post.jpg';

$date = $post['date'] ?? strtotime('1970-01-01');

// Include header/navigation
$page_title = $title . " - ByteSizeBible";
include __DIR__ . '/partials/header.php';
include __DIR__ . '/partials/navigation.php';
?>

<main>
    <article class="blog-post">
        <h1><?= htmlspecialchars($title) ?></h1>

        <?php if (!empty($bookLabel)): ?>
            <p class="blog-book"><?= htmlspecialchars($bookLabel) ?></p>
        <?php endif; ?>

        <?php if (!empty($scripture)): ?>
            <p class="blog-scripture"><?= htmlspecialchars($scripture) ?></p>
        <?php endif; ?>

        <p class="blog-date"><?= date('M d, Y', $date) ?></p>

        <?php if (!empty($image)): ?>
            <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($title) ?>" class="blog-image" />
        <?php endif; ?>

        <div class="blog-content blog-post-content">
            <?= $content ?>
        </div>
    </article>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>
