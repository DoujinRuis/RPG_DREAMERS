<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST RPG DREAMERS</title>
    <link rel="stylesheet" href="modules/style.css">
  </head>
  <body>
    <header>
      <h1>TEST RPG DREAMERS</h1>
      <nav>
        <ul>
          <li><a href="#welcomegame">ウェルカムゲーム</a></li>
          <li><a href="#games">ゲーム一覧</a></li>
          <li><a href="#upload">アップロード</a></li>
          <?php if (isset($_SESSION['username'])): ?>
            <li><a href="#mypage">マイページ</a></li>
            <li><a href="#logout">ログアウト</a></li>
          <?php else: ?>
            <li><a href="#register">ユーザー登録</a></li>
            <li><a href="#login">ログイン</a></li>
          <?php endif; ?>
        </ul>
      </nav>

      <div class="visitor-counter">
        <?php include __DIR__ . '/modules/counter.php'; ?>
      </div>
    </header>

    <main>
      <section id="welcomegame" class="section">
        <h2>ウェルカムゲーム</h2>
        <iframe src="welcomeGame/survival3D/index.html"
          width="1600" height="900"
          sandbox="allow-scripts">
        </iframe>
      </section>

      <section id="games" class="section">
        <h2>ゲーム一覧</h2>
        <ul id="game-list"></ul>

        <script>
          fetch('modules/list.php')
            .then(res => res.text())
            .then(html => {
                document.getElementById('game-list').innerHTML = html;
            })
            .catch(err => {
                document.getElementById('game-list').innerHTML = "<li>ゲーム一覧の読み込みに失敗しました。</li>";
                console.error(err);
            });
        </script>
      </section>

      <section id="upload" class="section">
        <h2>ゲームをアップロード</h2>
        <form action="modules/upload.php" method="POST" enctype="multipart/form-data">
          <label for="gameFiles">フォルダを選択:</label>
          <input type="file" name="gameFiles[]" id="gameFiles" webkitdirectory multiple required>
          <br><br>
          <button type="submit">アップロード</button>
        </form>
      </section>

      <?php if (isset($_SESSION['username'])): ?>
        <section id="mypage" class="section">
          <h2>マイページ</h2>
          <p>ようこそ、<?php echo htmlspecialchars($_SESSION['username']); ?>さん！</p>
        </section>

        <section id="logout" class="section">
          <h2>ログアウト</h2>
          <form id="logoutForm" method="POST" action="modules/logout.php">
            <button type="submit">ログアウト</button>
          </form>
        </section>

      <?php else: ?>
        <section id="register" class="section">
          <h2>ユーザー登録</h2>
          <form id="registerForm" method="POST" action="modules/register.php">
            <label for="username">ユーザー名</label>
            <input type="text" id="registerUsername" name="registerUsername" required>

            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" required>

            <label for="password">パスワード</label>
            <input type="password" id="registerPassword" name="registerPassword" required>

            <button type="submit">登録</button>
          </form>
          <p id="registerErrorMsg" class="submit-message"></p>
        </section>
        <script src="modules/register.js"></script>

        <section id="login" class="section">
          <h2>ログイン</h2>
          <form id="loginForm" method="POST" action="modules/login.php">
            <label for="username">ユーザー名</label>
            <input type="text" id="loginUsername" name="loginUsername" required>

            <label for="password">パスワード</label>
            <input type="password" id="loginPassword" name="loginPassword" required>

            <button type="submit">ログイン</button>
          </form>
          <p id="loginMsg" class="submit-message"></p>
          <script src="modules/login.js"></script>
        </section>
      <?php endif; ?>
    </main>

    <footer>
      <p>&copy; 2025 RPG DREAMERS</p>
    </footer>
  </body>
</html>
