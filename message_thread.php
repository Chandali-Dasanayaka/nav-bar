<?php
session_start();
// Dummy book data for demonstration
$books = [
  1 => [
    "title" => "City of Orange",
    "author" => "Erin Morgenstern",
    "cover" => "images/b2.jpeg",
    "desc" => "description.",
  ],
  2 => [
    "title" => "YOUR NAME HERE",
    "author" => "Unknown",
    "cover" => "images/b1.jpeg",
    "desc" => "Book description goes here.",
  ],
  3 => [
    "title" => "CITY OF ORANGE",
    "author" => "David Yoon",
    "cover" => "images/b3.jpeg",
    "desc" => "A gripping post-apocalyptic tale.",
  ],
];

// Get book_id from URL
$book_id = isset($_GET['book_id']) ? intval($_GET['book_id']) : 1;
$book = isset($books[$book_id]) ? $books[$book_id] : $books[1];

// Dummy messages data
$messages = [
  ["user" => "Courtney Henry", "avatar" => "images/b1.jpeg", "msg" => "அற்புதமான புத்தகம்! கதையின் ஒவ்வொரு பகுதியும் எனக்கு பிடித்தது.", "time" => "Hey - 2h"],
  ["user" => "Theresa Webb", "avatar" => "images/user2.jpg", "msg" => "நான் இன்னும் படிக்கவில்லை, விரைவில் வாசிப்பேன்.", "time" => "Hey - 2h"],
];
?>
<!DOCTYPE html>
<html lang="ta">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($book['title']) ?> - Message Thread</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"/>
</head>
<body class="bg-white text-gray-800 font-sans">
  <!-- Navbar -->
  <nav class="flex justify-between items-center p-4 bg-blue-800 shadow">
    <div class="flex items-center">
      <img src="images/logo.png" alt="Logo" class="h-8 w-8 mr-2" />
      <span class="font-bold text-lg text-white">BOOKS</span>
    </div>
    <input type="text" placeholder="Search book titles, authors, publishers..." class="w-1/2 px-4 py-2 border rounded"/>
    <div class="flex items-center space-x-2">
      <span class="text-green-300 text-sm">Online</span>
      <img src="images/b1.jpeg" class="w-8 h-8 rounded-full border" />
      <img src="images/user2.jpg" class="w-8 h-8 rounded-full border" />
      <img src="images/user3.jpg" class="w-8 h-8 rounded-full border" />
      <?php if(!isset($_SESSION['user_id'])): ?>
      <a href="login.php" class="bg-blue-500 text-white px-4 py-1 rounded ml-2 hover:bg-blue-600 transition">Login</a>
      <?php else: ?>
      <a href="logout.php" class="bg-gray-500 text-white px-4 py-1 rounded ml-2 hover:bg-gray-600 transition">Logout</a>
      <?php endif; ?>
    </div>
  </nav>

  <!-- Book Info Section -->
  <div class="px-4 py-6">
    <div class="bg-blue-100 rounded-xl p-8 flex items-center">
      <img src="<?= $book['cover'] ?>" class="w-48 h-64 rounded shadow-lg mr-8" />
      <div>
        <h2 class="text-3xl font-bold mb-2"><?= htmlspecialchars($book['title']) ?></h2>
        <div class="text-lg mb-2 text-gray-900">by <?= htmlspecialchars($book['author']) ?></div>
        <div class="text-sm text-gray-700"><?= htmlspecialchars($book['desc']) ?></div>
      </div>
    </div>
  </div>

  <!-- Message Thread Section -->
  <div class="px-4">
    <h3 class="font-semibold mb-2 text-lg">Message thread</h3>
    <?php if(isset($_SESSION['user_id'])): ?>
    <form method="POST" action="post_message.php?book_id=<?= $book_id ?>" class="mb-6 flex items-start">
      <img src="images/b1.jpeg" class="w-10 h-10 rounded-full border mr-3 mt-1" />
      <textarea name="message" placeholder="Add a comment..." class="flex-1 border rounded p-2 resize-none" rows="2" required></textarea>
      <button type="submit" class="ml-3 px-4 py-2 bg-blue-600 text-white rounded">Post</button>
    </form>
    <?php else: ?>
    <div class="mb-6">
      <a href="login.php" class="underline text-blue-600">Login to comment</a>
    </div>
    <?php endif; ?>

    <!-- Messages List -->
    <div class="bg-white">
      <?php foreach($messages as $msg): ?>
      <div class="flex items-start mb-4">
        <img src="<?= $msg['avatar'] ?>" class="w-10 h-10 rounded-full border mr-3" />
        <div>
          <div class="font-bold"><?= htmlspecialchars($msg['user']) ?></div>
          <div class="text-gray-800"><?= htmlspecialchars($msg['msg']) ?></div>
          <div class="text-xs text-gray-400"><?= $msg['time'] ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>