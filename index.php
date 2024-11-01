<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Biaya Pemakaian Listrik</title>
    <link rel="manifest" href="manifest.json">
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            background-color: white;
            padding-top: 280px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
     
        }

        h1 {
            background-color: #0080ff;
            text-align: center;
            color: #ffffff;
            font-size: 26px;
            padding: 12px;
            margin-bottom: -10px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            margin-left: 10px;
            color: #555;
        }

        form input {
            width: 90%; 
            padding: 10px;
            margin-bottom: 15px;
            margin-left: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            width: 40%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .results {
            margin-top: 20px;
        }

        .result-box {
            width: 90%; 
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            text-align: right;
            font-weight: bold;
            color: #333;
            font-size: 16px;
            margin-bottom: 15px;
            margin-left: 10px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            margin-left: 20px;
            color: #555;
        }
        li{
            background-color: #0080ff;
            color: #e6e600;
        }
      
select#language {
    width: 90%; 
    padding: 10px; 
    border: 1px solid #ddd; 
    border-radius: 5px; 
    margin-left: 10px; 
    margin-bottom: 15px;
    font-size: 16px; 
    color: #333;
    background-color: #ffffff; 
    transition: border-color 0.3s; 
}

select#language:focus {
    border-color: #0080ff; 
    outline: none; 
}

    </style>
</head>
<body>
    <div class="card">
        <h1 id="title">Hitung Biaya Listrik</h1>
        <li>By utility@trpc</li>
        <br>

        <!-- Language Selection -->
        <label for="language">Pilih Bahasa:</label>
        <select id="language" onchange="changeLanguage()">
            <option value="id">Bahasa Indonesia</option>
            <option value="en">English</option>
        </select>
        <br>

        <form>
            <div class="input-group">
                <label for="voltage" id="labelVoltage">Voltage (V): </label>
                <input type="number" id="voltage" name="voltage" value="0" min="0">
            </div>

            <div class="input-group">
                <label for="current" id="labelCurrent">Amper (A): </label>
                <input type="number" id="current" name="current" value="0" min="0">
            </div>

            <div class="input-group">
                <label for="powerFactor" id="labelPowerFactor">Power Factor (default 1 jika tidak tahu): </label>
                <input type="number" id="powerFactor" name="powerFactor" value="1" step="0.01" min="0">
            </div>

            <div class="input-group">
                <label for="rate" id="labelRate">Tarif Listrik /kWh (Rp): </label>
                <input type="number" id="rate" name="rate" value="1400" min="0">
            </div>

            <div class="input-group">
                <label for="hours" id="labelHours">Jumlah Jam Pemakaian: </label>
                <input type="number" id="hours" name="hours" value="1" min="0">
            </div>

            <button type="button" onclick="calculateKWhAndCost()" id="calculateButton">Hitung kWh dan Biaya</button>
        </form>

        <div class="results">
            <div class="result-group">
                <label for="power" id="labelPower">Daya (Watt):</label>
                <input type="text" id="power" class="result-box" readonly>
            </div>

            <div class="result-group">
                <label for="energy" id="labelEnergy">Konsumsi Energy (kWh):</label>
                <input type="text" id="energy" class="result-box" readonly>
            </div>

            <div class="result-group">
                <label for="totalCostPerHour" id="labelTotalCostPerHour">Total Biaya /Jam (Rp):</label>
                <input type="text" id="totalCostPerHour" class="result-box" readonly>
            </div>

            <div class="result-group">
                <label for="totalCostForHours" id="labelTotalCostForHours">Total Biaya untuk Jam Pemakaian (Rp):</label>
                <input type="text" id="totalCostForHours" class="result-box" readonly>
            </div>
        </div>
    </div>

    <script>
        const translations = {
            id: {
                title: "Hitung Biaya Listrik",
                labelVoltage: "Voltage (V): ",
                labelCurrent: "Amper (A): ",
                labelPowerFactor: "Power Factor (default 1 jika tidak tahu): ",
                labelRate: "Tarif Listrik /kWh (Rp): ",
                labelHours: "Jumlah Jam Pemakaian: ",
                calculateButton: "Hitung kWh dan Biaya",
                labelPower: "Daya (Watt):",
                labelEnergy: "Konsumsi Energi (kWh):",
                labelTotalCostPerHour: "Total Biaya /Jam (Rp):",
                labelTotalCostForHours: "Total Biaya untuk Jam Pemakaian (Rp):"
            },
            en: {
                title: "Electricity Usage Cost Calculator",
                labelVoltage: "Voltage (V): ",
                labelCurrent: "Current (A): ",
                labelPowerFactor: "Power Factor (default 1 if unknown): ",
                labelRate: "Electricity Rate /kWh (Currency): ",
                labelHours: "Number of Usage Hours: ",
                calculateButton: "Calculate kWh and Cost",
                labelPower: "Power (Watt):",
                labelEnergy: "Energy Consumption (kWh):",
                labelTotalCostPerHour: "Total Cost /Hour (Currency):",
                labelTotalCostForHours: "Total Cost for Usage Hours (Currency):"
            }
        };

        function changeLanguage() {
            const lang = document.getElementById("language").value;
            document.getElementById("title").innerText = translations[lang].title;
            document.getElementById("labelVoltage").innerText = translations[lang].labelVoltage;
            document.getElementById("labelCurrent").innerText = translations[lang].labelCurrent;
            document.getElementById("labelPowerFactor").innerText = translations[lang].labelPowerFactor;
            document.getElementById("labelRate").innerText = translations[lang].labelRate;
            document.getElementById("labelHours").innerText = translations[lang].labelHours;
            document.getElementById("calculateButton").innerText = translations[lang].calculateButton;
            document.getElementById("labelPower").innerText = translations[lang].labelPower;
            document.getElementById("labelEnergy").innerText = translations[lang].labelEnergy;
            document.getElementById("labelTotalCostPerHour").innerText = translations[lang].labelTotalCostPerHour;
            document.getElementById("labelTotalCostForHours").innerText = translations[lang].labelTotalCostForHours;
        }

       // Function to format numbers with currency symbol and thousand separators
function formatCurrency(amount) {
    // Convert to a number and format with thousand separators and currency symbol
    return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); 
}

function calculateKWhAndCost() {
    // Get input values
    const voltage = parseFloat(document.getElementById('voltage').value);
    const current = parseFloat(document.getElementById('current').value);
    const powerFactor = parseFloat(document.getElementById('powerFactor').value);
    const rate = parseFloat(document.getElementById('rate').value);
    const hours = parseFloat(document.getElementById('hours').value);

    // Calculate power (Watts)
    const power = voltage * current * powerFactor; // in Watts

    // Calculate energy consumption (kWh)
    const energy = (power / 1000) * hours; // in kWh

    // Calculate costs
    const totalCostPerHour = (power / 1000) * rate; // Cost for one hour
    const totalCostForHours = totalCostPerHour * hours; // Total cost for specified hours

    // Display results with formatting
    document.getElementById('power').value = power.toFixed(2); // Display power in Watts
    document.getElementById('energy').value = energy.toFixed(2); // Display energy in kWh
    document.getElementById('totalCostPerHour').value = formatCurrency(totalCostPerHour.toFixed(2)); // Display cost per hour
    document.getElementById('totalCostForHours').value = formatCurrency(totalCostForHours.toFixed(2)); // Display total cost
}

    </script>
      <script>
        // Daftar service worker
        if ("serviceWorker" in navigator) {
            navigator.serviceWorker.register("./service-worker.js")
            .then((registration) => {
                console.log("Service Worker terdaftar dengan sukses:", registration.scope);
            })
            .catch((error) => {
                console.log("Service Worker pendaftaran gagal:", error);
            });
        }
    </script>
</body>
</html>
