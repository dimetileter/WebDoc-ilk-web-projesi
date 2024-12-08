/*
function selection(selectStatus) {
    let url = "";
    if (selectStatus == "hasta") {
        url = "../sign-in-forms/hasta-girdileri.html";
    } else if (selectStatus == "personel") {
        url = "../sign-in-forms/personel-girdileri.html";
    }

    if (url) {
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTML dosyası yüklenemedi");
                }
                return response.text();
            })
            .then(html => {
                document.getElementById("dynamic-content").innerHTML = html;
            })
            .catch(error => {
                console.error("Hata:", error);
            });
    }
}
*/
