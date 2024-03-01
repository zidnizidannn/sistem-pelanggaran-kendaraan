const menuBtn = document.querySelector('#menuBtn');
const sidebar = document.querySelector('.sidebar');
menuBtn.addEventListener('click', function () {
    sidebar.classList.toggle('sidebar-collapse');
});

