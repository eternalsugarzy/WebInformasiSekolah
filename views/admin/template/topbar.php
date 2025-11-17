<div class="admin-header">
    <h4 style="margin:0; font-weight:700; color: #333; text-transform: uppercase;">
        <?php echo isset($title) ? $title : 'Admin Area'; ?>
    </h4>
    <div class="user-area">
        <span style="margin-right: 20px; font-weight:600; color:#555;">
            Hai, <?php echo isset($_SESSION['admin_nama']) ? $_SESSION['admin_nama'] : 'Admin'; ?>
        </span>
        <a href="logout.php" class="btn-logout" onclick="return confirm('Yakin ingin keluar?')">
            <i class="fa fa-power-off"></i> Logout
        </a>
    </div>
</div>