const form = document.querySelector(".wrapper form"),
FullUrl = form.querySelector("input"),
shortenBtn = form.querySelector("button"),
blue_effect = document.querySelector(".blur-effect"),
popup_box = document.querySelector(".popup-box"),
shorten_url = popup_box.querySelector("input");

form.onsubmit = (e) => {
    e.preventDefault();
}

shortenBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/urlcontrol.php", true);
    xhr.onload = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let data = xhr.response;
            if(data.length <= 5){
                blue_effect.style.display = "block";
                popup_box.classList.add("show");

                let domain = "localhost/url?u=";
                shorten_url.value = domain + data;
            } else{
                alert(data);
            }
        }
    };
    let formData = new FormData(form);
    xhr.send(formData);
}