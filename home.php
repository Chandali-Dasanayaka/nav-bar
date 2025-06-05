<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ta">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home - Books</title>
    <link
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
      rel="stylesheet"
    />
  </head>
  <body class="bg-white text-gray-800 font-sans">
    <!-- Navbar -->
    <nav class="flex justify-between items-center p-4 bg-blue-800 shadow">
      <div class="flex items-center">
        <img src="images/logo.png" alt="Logo" class="h-8 w-8 mr-2" />
        <span class="font-bold text-lg text-white">BOOKS</span>
      </div>
      <input
        type="text"
        placeholder="Search book titles, authors, publishers..."
        class="w-1/2 px-4 py-2 border rounded"
      />
      <div class="flex items-center space-x-2">
        <span class="text-green-300 text-sm">Online</span>
        <img src="images/b1.jpeg" alt="User 1" class="w-8 h-8 rounded-full border" />
        <img src="images/user2.jpg" alt="User 2" class="w-8 h-8 rounded-full border" />
        <img src="images/user3.jpg" alt="User 3" class="w-8 h-8 rounded-full border" />
        <?php if(!isset($_SESSION['user_id'])): ?>
        <a
          href="login.php"
          class="bg-blue-500 text-white px-4 py-1 rounded ml-2 hover:bg-blue-600 transition"
        >Login</a>
        <?php else: ?>
        <a
          href="logout.php"
          class="bg-gray-500 text-white px-4 py-1 rounded ml-2 hover:bg-gray-600 transition"
        >Logout</a>
        <?php endif; ?>
      </div>
    </nav>

    <!-- Slider -->
    <section
      class="relative flex overflow-x-auto py-8 px-4 bg-cover bg-center"
      style="background-image: url('images/bg.jpg')"
    >
      <?php
      $sliderBooks = [
        ['cover' => 'images/b1.jpeg', 'label' => 1],
        ['cover' => 'images/b2.jpeg', 'label' => 2],
        ['cover' => 'images/b3.jpeg', 'label' => 3],
        ['cover' => 'images/b4.jpeg', 'label' => 4],
      ];
      foreach ($sliderBooks as $book): ?>
      <div class="relative w-40 flex-shrink-0 text-center mx-2">
        <img src="<?= $book['cover'] ?>" alt="Book <?= $book['label'] ?>" class="w-full rounded shadow-lg" />
        <span class="absolute -top-2 -left-2 bg-red-600 text-white text-xs px-2 py-1 rounded-full">
          <?= $book['label'] ?>
        </span>
      </div>
      <?php endforeach; ?>
    </section>

    <!-- Recommendations & Filters -->
    <div class="flex flex-col md:flex-row px-4 py-6 gap-6">
      <!-- Left: Book Tabs -->
      <div class="md:w-2/3">
        <div class="flex space-x-6 border-b pb-2 mb-4">
          <button
            onclick="showTab('books')"
            class="font-semibold text-blue-600 border-b-2 border-blue-600"
          >Books</button>
          <button
            onclick="showTab('all')"
            class="text-gray-600 hover:text-blue-600"
          >All Book Recommendations</button>
        </div>

        <!-- Tab 1: Static Books -->
        <div id="booksTab">
          <div class="bg-gray-100 p-4 rounded mb-4 flex">
            <img src="images/b1.jpeg" alt="Book 1" class="w-16 h-20 mr-4 rounded" />
            <div>
              <h4 class="font-bold text-sm">YOUR NAME HERE</h4>
              <p class="text-sm text-gray-700">dfggh</p>
            </div>
          </div>
          <div class="bg-gray-100 p-4 rounded mb-4 flex">
            <img src="images/b2.jpeg" alt="Book 2" class="w-16 h-20 mr-4 rounded" />
            <div>
              <h4 class="font-bold text-sm">CITY OF ORANGE</h4>
              <p class="text-sm text-gray-700">asdff</p>
            </div>
          </div>
          <div class="bg-gray-100 p-4 rounded mb-4 flex">
            <img src="images/b3.jpeg" alt="Book 3" class="w-16 h-20 mr-4 rounded" />
            <div>
              <h4 class="font-bold text-sm">HARRY POTTER</h4>
              <p class="text-sm text-gray-700">gdfds</p>
            </div>
          </div>
        </div>

        <!-- Tab 2: Dynamic Recommendations -->
        <div id="allTab" class="hidden">
          <?php
          $books = [
            [
              "id" => 1,
              "title" => "NIGHT CIRCUS",
              "author" => "Erin Morgenstern",
              "cover" => "images/b2.jpeg",
              "desc" => "A magical novel about a mysterious circus that appears only at night.",
            ],
            [
              "id" => 2,
              "title" => "YOUR NAME HERE",
              "author" => "Unknown",
              "cover" => "images/b1.jpeg",
              "desc" => "Book description goes here.",
            ],
            [
              "id" => 3,
              "title" => "CITY OF ORANGE",
              "author" => "David Yoon",
              "cover" => "images/b3.jpeg",
              "desc" => "A gripping post-apocalyptic tale.",
            ],
          ];
          foreach ($books as $book): ?>
          <a
            href="message_thread.php?book_id=<?= $book['id'] ?>"
            class="block bg-gray-100 p-4 rounded mb-4 flex hover:bg-gray-200 transition"
          >
            <img src="<?= $book['cover'] ?>" alt="<?= htmlspecialchars($book['title']) ?>" class="w-16 h-20 mr-4 rounded" />
            <div>
              <h4 class="font-bold text-sm"><?= htmlspecialchars($book['title']) ?></h4>
              <p class="text-sm text-gray-700"><?= htmlspecialchars($book['desc']) ?></p>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Right: Filter -->
      <div class="md:w-1/3">
        <h4 class="font-bold mb-3">Book genres</h4>
        <div class="flex flex-wrap gap-2">
          <?php
          $genres = ["Action", "Romance", "Horror", "Mystery", "Drama"];
          foreach ($genres as $genre): ?>
          <button class="px-3 py-1 bg-gray-200 rounded-full text-sm"><?= $genre ?></button>
          <?php endforeach; ?>
          <button class="px-4 py-1 bg-red-500 text-white rounded-full text-sm">View All</button>
        </div>
      </div>
    </div>

    <!-- Tab Script -->
    <script>
      function showTab(tab) {
        document.getElementById("booksTab").style.display = tab === "books" ? "block" : "none";
        document.getElementById("allTab").style.display = tab === "all" ? "block" : "none";
      }
    </script>
  </body>
</html>
