const logoutBtn = document.querySelector('button#logout');

logoutBtn.addEventListener('click', function (event) {
  event.preventDefault();
  document.cookie = 'token=';
  window.location.href = '/login';
});
