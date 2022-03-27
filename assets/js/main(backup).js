let btnnav = 0;
const SESSION_KEY = "saved_key";

document.addEventListener("DOMContentLoaded", function () {
	loadStorageExist();
	$("#sidebarCollapse").on("click", function () {
		$("#sidebar").toggleClass("active");
	});
});

document
	.getElementById("sidebarCollapse")
	.addEventListener("click", function () {
		if (btnnav == 0) {
			btnnav = 1;
			saveData();
		} else {
			btnnav = 0;
			saveData();
		}
	});

function saveData() {
	const data = JSON.stringify(btnnav);
	sessionStorage.setItem(SESSION_KEY, data);
}

function loadStorageExist() {
	const dataInStorage = sessionStorage.getItem(SESSION_KEY);

	let data = JSON.parse(dataInStorage);

	if (data != null) {
		btnnav = data;
		if (btnnav == 1) {
			document.getElementById("sidebar").classList.add("active");
		}
	}
}
