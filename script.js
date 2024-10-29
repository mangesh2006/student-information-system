const add = document.getElementById("add");
document.addEventListener("DOMContentLoaded", () => {
    add.addEventListener("click", () => {
        window.location.href = "add.php";
    })
})
const search = document.getElementById("search");
document.addEventListener("DOMContentLoaded", () => {
    search.addEventListener("click", () => {
        window.location.href = "search.php";
    })
})
const del = document.getElementById("delete");
document.addEventListener("DOMContentLoaded", () => {
    del.addEventListener("click", () => {
        window.location.href = "delete.php";
    })
})
const upd = document.getElementById("update");
document.addEventListener("DOMContentLoaded", () => {
    upd.addEventListener("click", () => {
        window.location.href = "update.php";
    })
})