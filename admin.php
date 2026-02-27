<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
include 'config.php';

// Statistiques tsotra
$total_cmd = $conn->query("SELECT COUNT(*) as total FROM commandes")->fetch_assoc()['total'];
$total_vola = $conn->query("SELECT SUM(total) as vola FROM commandes")->fetch_assoc()['vola'];
?>
<!DOCTYPE html>
<html lang="mg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grace Admin | Premium Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #9d4edd;
            --secondary: #5a189a;
            --bg: #050508;
            --card-bg: rgba(255, 255, 255, 0.03);
            --border: rgba(255, 255, 255, 0.08);
            --text: #ffffff;
            --text-dim: #94a3b8;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            background: var(--bg);
            color: var(--text);
            background-image: 
                radial-gradient(circle at 10% 10%, rgba(157, 78, 221, 0.1) 0%, transparent 40%),
                radial-gradient(circle at 90% 90%, rgba(90, 24, 154, 0.1) 0%, transparent 40%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container { max-width: 1200px; margin: 0 auto; }

        /* Header */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }
        
        .logo { font-size: 1.8rem; font-weight: 800; letter-spacing: -1px; }
        .logo span { color: var(--primary); }

        .btn-logout {
            background: rgba(255, 77, 77, 0.1);
            color: #ff4d4d;
            padding: 10px 20px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            border: 1px solid rgba(255, 77, 77, 0.2);
            transition: 0.3s;
        }
        .btn-logout:hover { background: #ff4d4d; color: white; }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 24px;
            border: 1px solid var(--border);
            backdrop-filter: blur(12px);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: ""; position: absolute; top: 0; left: 0; width: 4px; height: 100%; background: var(--primary);
        }

        .stat-card h3 { font-size: 0.85rem; color: var(--text-dim); text-transform: uppercase; letter-spacing: 1px; }
        .stat-card .value { font-size: 2.2rem; font-weight: 800; margin-top: 10px; color: #fff; }
        .stat-card i { position: absolute; right: 25px; bottom: 25px; font-size: 2.5rem; color: rgba(157, 78, 221, 0.1); }

        /* Table */
        .table-wrapper {
            background: var(--card-bg);
            border-radius: 24px;
            border: 1px solid var(--border);
            overflow: hidden;
            backdrop-filter: blur(12px);
        }

        table { width: 100%; border-collapse: collapse; text-align: left; }
        
        th { 
            padding: 20px; background: rgba(157, 78, 221, 0.05); 
            font-size: 0.75rem; text-transform: uppercase; color: var(--primary); font-weight: 700;
        }
        
        td { padding: 20px; border-bottom: 1px solid var(--border); font-size: 0.9rem; }
        tr:hover { background: rgba(255, 255, 255, 0.02); }

        .client-name { font-weight: 700; display: block; font-size: 1rem; margin-bottom: 4px; }
        .client-fb { color: var(--text-dim); font-size: 0.8rem; display: flex; align-items: center; gap: 6px; }

        .price-badge {
            background: rgba(157, 78, 221, 0.15);
            color: var(--primary);
            padding: 6px 12px;
            border-radius: 10px;
            font-weight: 800;
            border: 1px solid rgba(157, 78, 221, 0.2);
        }

        .status-pill {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
            padding: 5px 12px;
            border-radius: 100px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
        }

    </style>
</head>
<body>

<div class="container">
    <header>
        <div class="logo">Grace<span>Admin</span></div>
        <a href="logout.php" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Hivoaka</a>
    </header>

    <div class="stats-grid">
        <div class="stat-card">
            <h3>Baiko voaray</h3>
            <div class="value"><?php echo $total_cmd; ?></div>
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="stat-card">
            <h3>Vola maty (Total)</h3>
            <div class="value"><?php echo number_format($total_vola, 0, '', ' '); ?> Ar</div>
            <i class="fas fa-wallet"></i>
        </div>
        <div class="stat-card">
            <h3>Mpividy vaovao</h3>
            <div class="value"><?php echo $total_cmd; ?></div>
            <i class="fas fa-user-check"></i>
        </div>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Daty</th>
                    <th>Mpanjifa</th>
                    <th>Contact & Adiresy</th>
                    <th>Stickers novidiana</th>
                    <th>Vola aloa</th>
                    <th>Etat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM commandes ORDER BY date_commande DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td style='color: var(--text-dim)'>" . date('d/m/y', strtotime($row['date_commande'])) . "<br><small>" . date('H:i', strtotime($row['date_commande'])) . "</small></td>
                            <td>
                                <span class='client-name'>{$row['nom_client']}</span>
                                <span class='client-fb'><i class='fab fa-facebook'></i> {$row['fb_client']}</span>
                            </td>
                            <td>
                                <b>{$row['tel']}</b><br>
                                <small style='color: var(--text-dim)'>{$row['adresse']}</small>
                            </td>
                            <td style='max-width: 200px; font-size: 0.8rem;'>{$row['produits']}</td>
                            <td><span class='price-badge'>" . number_format($row['total'], 0, '', ' ') . " Ar</span></td>
                            <td><span class='status-pill'>Vaovao</span></td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center; padding: 60px; color: var(--text-dim);'>Tsy mbola misy commande... 🚀</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>