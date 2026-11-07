// Mobile navigation toggle
document.addEventListener('DOMContentLoaded', function () {
    var toggle = document.getElementById('navToggle');
    var menu = document.getElementById('navMenu');
    if (toggle && menu) {
        toggle.addEventListener('click', function () {
            var open = menu.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    }
});

// Search + filter for the collection page (frontend only)
function initCollectionFilter() {
    var search = document.getElementById('searchInput');
    var category = document.getElementById('categoryFilter');
    var status = document.getElementById('statusFilter');
    var items = document.querySelectorAll('#bookGrid .book-wrap');
    var empty = document.getElementById('emptyState');
    var count = document.getElementById('resultCount');
    if (!search || !category || !status) { return; }

    function apply() {
        var q = search.value.trim().toLowerCase();
        var visible = 0;
        items.forEach(function (el) {
            var matchText = !q || el.dataset.title.indexOf(q) !== -1 || el.dataset.author.indexOf(q) !== -1;
            var matchCat = !category.value || el.dataset.category === category.value;
            var matchStatus = !status.value || el.dataset.status === status.value;
            var show = matchText && matchCat && matchStatus;
            el.hidden = !show;
            if (show) { visible++; }
        });
        empty.hidden = visible !== 0;
        count.textContent = 'Showing ' + visible + ' of ' + items.length + ' books';
    }

    search.addEventListener('input', apply);
    category.addEventListener('change', apply);
    status.addEventListener('change', apply);
}
