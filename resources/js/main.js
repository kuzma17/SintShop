

const myCollapsible = document.getElementById('collapseExample')
myCollapsible.addEventListener('shown.bs.collapse', event => {

    alert(5454);
    document.querySelectorAll(".box").forEach(box => { box.style.display = "none" });

});
