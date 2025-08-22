function sendToServer(action) {
  const text = document.getElementById("inputtext").value;
  const key = document.getElementById("key").value;

  if (!text || !key) {
    alert("Please enter both text and key!");
    return;
  }

  const formData = new FormData();
  formData.append("text", text);
  formData.append("key", key);
  formData.append("action", action);

  fetch("vigenere.php", {
    method: "POST",
    body: formData
  })
    .then(response => response.text())
    .then(result => {
      document.getElementById("result").innerText = result;
    })
    .catch(error => {
      console.error("Error:", error);
      alert("Something went wrong.");
    });
}

function encrypt() {
  sendToServer("encrypt");
}

function decrypt() {
  sendToServer("decrypt");
}
