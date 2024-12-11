/*
function navigatePage(page) {
    // URL'yi güncelle
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('page', page);
    window.history.pushState({}, '', '?' + urlParams.toString());

    // Sayfayı dinamik olarak yükle
    loadContent(page);
}

function loadContent(page) {
    const contentDiv = document.getElementById("content");

    fetch(`../main-page-links/${page}.php`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text();
        })
        .then(html => {
            contentDiv.innerHTML = html;
        })
        .catch(error => {
            console.error("Sayfa yükleme hatası:", error);
            contentDiv.innerHTML = "<p>Sayfa yüklenirken bir hata oluştu.</p>";
        });
}
*/
