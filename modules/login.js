// ログイン

document.getElementById('loginForm').addEventListener('submit', function(e) {
  e.preventDefault(); 
  const username = document.getElementById('loginUsername').value.trim();
  const password = document.getElementById('loginPassword').value;
  const message = document.getElementById('loginMsg');

  if (!username || !password) {
    message.textContent = 'ユーザー名とパスワードを入力してください。';
    return;
  }

  const formData = new FormData(this);

  fetch("modules/login.php", {
    method: "POST",
    body: formData,
    credentials: "include"
  })
  .then(res => res.text())
  .then(text => {
    if (text === 'success') {
      message.textContent = 'ログイン成功！';
      location.reload();
    } else {
      message.textContent = 'ログイン失敗';
    }
  });
});
