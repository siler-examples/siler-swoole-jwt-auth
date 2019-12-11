const loginForm = document.querySelector('form#login');

loginForm.addEventListener('submit', function (event) {
  event.preventDefault();
  const data = new FormData(event.currentTarget);
  const username = data.get('username');
  const password = data.get('password');

  fetch(`http://localhost:3000/login`, {
    method: 'post',
    body: JSON.stringify({
      username,
      password
    })
  }).then(response => response.json())
    .then(response => {
      if (response.error) {
        console.error(response.message);
        alert(response.message);
        return;
      }

      document.cookie = `token=${response.data}`;
      window.location.href = '/dashboard';
    });
});
