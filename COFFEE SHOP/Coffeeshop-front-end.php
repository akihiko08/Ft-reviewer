<?php 
require 'coffeeshop-back-end.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <style>

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --espresso:    #1C0F07;
            --roast:       #3B1F0E;
            --mahogany:    #5C2E10;
            --caramel:     #B5651D;
            --latte:       #C8A27A;
            --cream:       #F5ECD7;
            --parchment:   #FAF4E8;
            --warm-white:  #FFFDF7;
            --muted:       #7A5C3E;
            --shadow-warm: rgba(28, 15, 7, 0.15);
        }

        body {
            font-family: 'Lato', sans-serif;
            background-color: var(--parchment);
            background-image:
                radial-gradient(ellipse at 20% 10%, rgba(181, 101, 29, 0.08) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 90%, rgba(92, 46, 16, 0.07) 0%, transparent 50%);
            min-height: 100vh;
            padding: 40px 30px;
            color: var(--espresso);
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-header .logo-ring {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: var(--roast);
            margin-bottom: 14px;
            box-shadow: 0 4px 16px var(--shadow-warm);
            font-size: 28px;
        }

        .page-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--roast);
        }

        .page-header p {
            font-size: 13px;
            color: var(--muted);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 4px;
            font-weight: 300;
        }

        .top-row {
            display: flex;
            gap: 20px;
            align-items: flex-start;
            width: 100%;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .box {
            flex: 1;
            min-width: 220px;
            background-color: var(--warm-white);
            border-radius: 16px;
            padding: 22px 20px;
            box-shadow: 0 2px 8px var(--shadow-warm), 0 0 0 1px rgba(92, 46, 16, 0.08);
            border-top: 4px solid var(--caramel);
        }

        .box h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--roast);
            margin-bottom: 18px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(92, 46, 16, 0.12);
        }

        p.label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px 13px;
            margin-bottom: 13px;
            border: 1.5px solid rgba(92, 46, 16, 0.2);
            border-radius: 8px;
            background: var(--parchment);
            color: var(--espresso);
            font-family: 'Lato', sans-serif;
            font-size: 13px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input[type="text"]:focus {
            border-color: var(--caramel);
            box-shadow: 0 0 0 3px rgba(181, 101, 29, 0.12);
            background: var(--warm-white);
        }

        input[type="text"]::placeholder { color: var(--latte); }

        button {
            width: 100%;
            padding: 11px 14px;
            border: none;
            border-radius: 8px;
            font-family: 'Lato', sans-serif;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.15s, background-color 0.2s;
            margin-bottom: 8px;
        }

        button:last-child { margin-bottom: 0; }
        button:active { transform: scale(0.97); }

        .btn-primary {
            background-color: var(--mahogany);
            color: var(--cream);
            box-shadow: 0 3px 10px rgba(92, 46, 16, 0.3);
        }

        .btn-primary:hover {
            background-color: var(--roast);
        }

        .btn-secondary {
            background-color: var(--cream);
            color: var(--mahogany);
            border: 1.5px solid rgba(92, 46, 16, 0.25);
        }

        .btn-secondary:hover { background-color: #EDD9B8; }

        .btn-danger {
            background-color: #7B2020;
            color: #FAE8E8;
            box-shadow: 0 3px 10px rgba(123, 32, 32, 0.3);
        }

        .btn-danger:hover { background-color: #5C1515; }

        hr {
            border: none;
            border-top: 1px solid rgba(92, 46, 16, 0.12);
            margin: 16px 0;
        }

        .result-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 10px;
        }

        .result-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 0;
            border-bottom: 1px dashed rgba(181, 101, 29, 0.15);
            margin-bottom: 4px;
        }

        .result-row:last-of-type { border-bottom: none; }

        .result-row .key {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--muted);
        }

        .result-row .val {
            font-size: 13px;
            color: var(--espresso);
        }

        .not-found {
            font-size: 13px;
            color: #7B2020;
            font-style: italic;
            margin-top: 8px;
        }

        .table-box {
            background-color: var(--warm-white);
            border-radius: 16px;
            padding: 22px 20px;
            box-shadow: 0 2px 8px var(--shadow-warm), 0 0 0 1px rgba(92, 46, 16, 0.08);
            border-top: 4px solid var(--caramel);
            overflow-x: auto;
        }

        .table-box-header {
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--roast);
            margin-bottom: 16px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(92, 46, 16, 0.12);
        }

        table { width: 100%; border-collapse: collapse; }

        th {
            background-color: var(--roast);
            color: var(--cream);
            padding: 12px 16px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            font-family: 'Lato', sans-serif;
            text-align: center;
        }

        th:first-child { border-radius: 8px 0 0 8px; }
        th:last-child  { border-radius: 0 8px 8px 0; }

        td {
            padding: 12px 16px;
            text-align: center;
            border-bottom: 1px solid rgba(92, 46, 16, 0.07);
            font-size: 13.5px;
            color: var(--espresso);
        }

        tr:last-child td { border-bottom: none; }
        tbody tr:hover td { background-color: rgba(245, 236, 215, 0.45); }

        td:first-child {
            font-weight: 700;
            color: var(--mahogany);
            font-size: 12px;
        }

        .alert {
            margin-top: 20px;
            padding: 14px 18px;
            border-radius: 10px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #EEF6EE;
            color: #2D5A2D;
            border-left: 4px solid #5A9E5A;
        }

        .alert-danger {
            background-color: #FAF0F0;
            color: #7B2020;
            border-left: 4px solid #C05050;
        }

        .empty-state td {
            padding: 30px 16px;
            color: var(--muted);
            font-style: italic;
            font-size: 14px;
        }

    </style>
</head>

<body>

    <div class="page-header">
        <div class="logo-ring">☕</div>
        <h1>Coffee Shop Management</h1>
        <p>Menu &amp; Inventory Control</p>
    </div>

    <div class="top-row">

        <!-- 1. INSERT -->
        <div class="box">
            <h3>➕ Add Coffee</h3>
            <form action="" method="POST">
                <p class="label">Coffee Name</p>
                <input type="text" name="name" placeholder="e.g. Caramel Latte" required>

                <p class="label">Price</p>
                <input type="text" name="price" placeholder="e.g. 120" required>

                <p class="label">Availability</p>
                <input type="text" name="availability" placeholder="e.g. Available" required>

                <p class="label">Popularity</p>
                <input type="text" name="popularity" placeholder="e.g. High" required>

                <button type="submit" name="insert" class="btn-primary">Add Coffee</button>
            </form>
        </div>

        <!-- 2. UPDATE -->
        <div class="box">
            <h3>✏️ Update Coffee</h3>

            <form action="" method="POST">
                <p class="label">Search by Coffee ID</p>
                <input type="text" name="search_coffee_id" placeholder="Enter Coffee ID" required>
                <button type="submit" name="search_update" class="btn-secondary">Search</button>
            </form>

            <?php if (isset($data)): ?>
                <hr>
                <p class="result-label">Editing Coffee #<?php echo htmlspecialchars($data['coffee_id']); ?></p>
                <form action="" method="POST">
                    <input type="hidden" name="coffee_id" value="<?php echo htmlspecialchars($data['coffee_id']); ?>">

                    <p class="label">Coffee Name</p>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($data['name']); ?>" required>

                    <p class="label">Price</p>
                    <input type="text" name="price" value="<?php echo htmlspecialchars($data['price']); ?>" required>

                    <p class="label">Availability</p>
                    <input type="text" name="availability" value="<?php echo htmlspecialchars($data['availability']); ?>" required>

                    <p class="label">Popularity</p>
                    <input type="text" name="popularity" value="<?php echo htmlspecialchars($data['popularity']); ?>" required>

                    <button type="submit" name="update" class="btn-primary">Update Coffee</button>
                </form>
            <?php elseif (isset($_POST['search_update'])): ?>
                <p class="not-found">No coffee found with that ID.</p>
            <?php endif; ?>
        </div>

        <!-- 3. DELETE -->
        <div class="box">
            <h3>🗑️ Delete Coffee</h3>

            <form action="" method="POST">
                <p class="label">Search by Coffee ID</p>
                <input type="text" name="delete_coffee_id" placeholder="Enter Coffee ID" required>
                <button type="submit" name="search_delete" class="btn-secondary">Search</button>
            </form>

            <?php if (isset($delete_data)): ?>
                <hr>
                <p class="result-label">Confirm Delete</p>
                <div class="result-row">
                    <span class="key">ID</span>
                    <span class="val"><?php echo htmlspecialchars($delete_data['coffee_id']); ?></span>
                </div>
                <div class="result-row">
                    <span class="key">Name</span>
                    <span class="val"><?php echo htmlspecialchars($delete_data['name']); ?></span>
                </div>
                <div class="result-row">
                    <span class="key">Price</span>
                    <span class="val"><?php echo htmlspecialchars($delete_data['price']); ?></span>
                </div>
                <div class="result-row">
                    <span class="key">Availability</span>
                    <span class="val"><?php echo htmlspecialchars($delete_data['availability']); ?></span>
                </div>
                <div class="result-row">
                    <span class="key">Popularity</span>
                    <span class="val"><?php echo htmlspecialchars($delete_data['popularity']); ?></span>
                </div>

                <br>
                <form action="" method="POST">
                    <input type="hidden" name="delete_coffee_id" value="<?php echo htmlspecialchars($delete_data['coffee_id']); ?>">
                    <button type="submit" name="delete" class="btn-danger">Confirm Delete</button>
                </form>

            <?php elseif (isset($_POST['search_delete'])): ?>
                <p class="not-found">No coffee found with that ID.</p>
            <?php endif; ?>
        </div>

    </div>

    <!-- TABLE -->
    <div class="table-box">
        <div class="table-box-header">☕ Coffee Menu</div>
        <table>
            <thead>
                <tr>
                    <th>Coffee ID</th>
                    <th>Coffee Name</th>
                    <th>Price</th>
                    <th>Availability</th>
                    <th>Popularity</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($handler->num_rows > 0): ?>
                    <?php while ($row = $handler->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['coffee_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['price']); ?></td>
                            <td><?php echo htmlspecialchars($row['availability']); ?></td>
                            <td><?php echo htmlspecialchars($row['popularity']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr class="empty-state">
                        <td colspan="5">No coffee data found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- ALERTS -->
    <?php if (isset($inserted)): ?>
        <div class="alert <?php echo strpos($inserted, 'Error') === false ? 'alert-success' : 'alert-danger'; ?>">
            <?php echo $inserted; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($edited)): ?>
        <div class="alert alert-success"><?php echo $edited; ?></div>
    <?php endif; ?>

    <?php if (isset($deleted)): ?>
        <div class="alert alert-success"><?php echo $deleted; ?></div>
    <?php endif; ?>

</body>
</html>