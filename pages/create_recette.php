<?php
include '../classes/Client.php';
include('../views/sidebar.php');

$clientManager = new Client($conn);
$clients = $clientManager->listClients();

$selectedClientId = isset($_GET['client_id']) ? $_GET['client_id'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client List - Create Bill</title>
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    color: #333;
}



.main-content h2 {
    color: #0056b3;
    font-size: 24px;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    font-size: 16px;
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left;
}

th {
    background-color: #f2f2f2;
    font-weight: bold;
}

.select-button, .submit-button, .add-item-button {
    padding: 8px 16px;
    font-size: 14px;
    color: white;
    background-color: #0056b3;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-decoration: none;
    display: inline-block;
}

.select-button:hover, .submit-button:hover, .add-item-button:hover {
    background-color: #004494;
}

.edit {
    color: blue;
    text-decoration: none;
}

/* Form styling */
form {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

label {
    font-size: 14px;
    margin-bottom: 5px;
    color: #333;
}

input[type="text"],
input[type="number"],
input[type="date"] {
    padding: 10px;
    width: 100%;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    outline-color: #0056b3;
}

input[type="text"]:focus, input[type="number"]:focus, input[type="date"]:focus {
    border-color: #0056b3;
}

button.add-item-button {
    background-color: #28a745;
    margin-top: 10px;
}

button.add-item-button:hover {
    background-color: #218838;
}

@media (max-width: 768px) {
    .container {
        width: 95%;
        padding: 15px;
    }

    th, td {
        padding: 8px;
    }

    .select-button, .submit-button, .add-item-button {
        padding: 8px;
        font-size: 12px;
    }
}
.button {
 display: flex;
 height: 3em;
 width: 100px;
 align-items: center;
 justify-content: center;
 background-color: #eeeeee4b;
 border-radius: 3px;
 letter-spacing: 1px;
 transition: all 0.2s linear;
 cursor: pointer;
 border: none;
 background: #fff;
}

.button > svg {
 margin-right: 5px;
 margin-left: 5px;
 font-size: 20px;
 transition: all 0.4s ease-in;
}

.button:hover > svg {
 font-size: 1.2em;
 transform: translateX(-5px);
}

.button:hover {
 box-shadow: 9px 9px 33px #d1d1d1, -9px -9px 33px #ffffff;
 transform: translateY(-2px);
}

    </style>
</head>
<body>

<div class="container">
    <div class="main-content">

        <?php if (!$selectedClientId): ?>
            <h2>Select a Client to Create Bill</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($client['id']); ?></td>
                            <td><?php echo htmlspecialchars($client['nom']); ?></td>
                            <td><?php echo htmlspecialchars($client['prenom']); ?></td>
                            <td><?php echo htmlspecialchars($client['email']); ?></td>
                            <td>
                                <a href="?client_id=<?php echo $client['id']; ?>" class="select-button">Select</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php else: ?>
            <a class="button" href="create_recette.php">
             <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
               <span>Back</span>
               </a> 
            <h2>Create Bill for Client #<?php echo htmlspecialchars($selectedClientId); ?></h2>
           <form action="process_bill.php" method="POST">
                <input type="hidden" name="client_id" value="<?php echo htmlspecialchars($selectedClientId); ?>">

                <label for="bill_date">Bill Date:</label>
                <input type="date" id="bill_date" name="bill_date" required>

                <label for="due_date">Due Date:</label>
                <input type="date" id="due_date" name="due_date" required>

                <div id="item-list">
                    <div class="item-entry">
                        <label for="item_description">Item Description:</label>
                        <input type="text" id="item_description" name="item_description[]" required>

                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity[]" required>

                        <label for="price">Price:</label>
                        <input type="number" step="0.01" id="price" name="price[]" required>
                    </div>
                </div>

                <button type="button" class="add-item-button" onclick="addItem()">Add Item</button>
                <button type="submit" class="submit-button">Create Bill</button>
            </form>

            <script>
                function addItem() {
                    const itemList = document.getElementById('item-list');
                    const newItem = document.createElement('div');
                    newItem.classList.add('item-entry');
                    newItem.innerHTML = `
                        <label for="item_description">Item Description:</label>
                        <input type="text" name="item_description[]" required>
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity[]" required>
                        <label for="price">Price:</label>
                        <input type="number" step="0.01" name="price[]" required>
                    `;
                    itemList.appendChild(newItem);
                }
            </script>

        <?php endif; ?>

    </div>
</div>

</body>
</html>
