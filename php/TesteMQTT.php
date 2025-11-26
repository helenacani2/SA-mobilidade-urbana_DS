<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <title>MQTT Dashboard PHP</title>
    <script>

        function fetchMessages() {
            var temp = document.getElementById("temperature");

        fetch('MensagensMQTT.php')
                .then(r => r.text())
                .then(data => {
                    console.log("Recebido:", data);
                    if (data.trim() != "") {
                        temp.textContent = data.trim();
                    }
                })
                .catch(err => console.error(err));
        }

        // Polling a cada 1 segundo
        setInterval(fetchMessages, 2000);
        fetchMessages();
    </script>
</head>

<body>
    <span>Temperatura</span>
    <h1 id="temperature">xxxx</h1>
</body>

</html>