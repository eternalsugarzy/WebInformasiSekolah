<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo isset($title) ? $title : 'Admin Panel'; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/font-awesome.min.css">

    <link type="text/css" rel="stylesheet" href="../css/style.css"/>

    <style>
        body { background-color: #f5f7fa; font-family: 'Montserrat', sans-serif; padding-top: 0; }
        
        /* Sidebar Styling */
        .admin-sidebar { width: 260px; height: 100vh; background: #2B2D42; position: fixed; left: 0; top: 0; z-index: 100; transition: all 0.3s; box-shadow: 4px 0 10px rgba(0,0,0,0.1); }
        .admin-brand { height: 70px; display: flex; align-items: center; padding-left: 30px; background: #252739; border-bottom: 1px solid #3a3c55; }
        .admin-brand h3 { color: #fff; margin: 0; font-size: 18px; font-weight: 700; text-transform: uppercase; }
        .admin-brand span { color: #FF6700; }

        .sidebar-menu { list-style: none; padding: 20px 0; margin: 0; }
        .sidebar-menu li a { display: block; padding: 15px 30px; color: #b7c0cd; text-decoration: none; transition: 0.3s; font-size: 14px; border-left: 4px solid transparent; }
        .sidebar-menu li a:hover, .sidebar-menu li.active a { background: #32344d; color: #fff; border-left-color: #FF6700; }
        .sidebar-menu li a i { width: 25px; margin-right: 10px; }
        
        /* Main Content Area */
        .main-content { margin-left: 260px; transition: all 0.3s; }
        .admin-header { background: #fff; height: 70px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; padding: 0 40px; }
        .content-wrapper { padding: 40px; }
        
        /* Widgets & Cards */
        .stat-card { background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px; border-bottom: 3px solid transparent; transition: transform 0.3s; }
        .stat-card:hover { transform: translateY(-5px); }
        .stat-content h3 { margin: 0; font-size: 32px; font-weight: 700; color: #333; }
        .stat-content p { margin: 5px 0 0; color: #888; font-size: 13px; text-transform: uppercase; font-weight: 600; }
        .stat-icon { width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; }
        
        /* Colors */
        .card-orange { border-bottom-color: #FF6700; }
        .card-orange .stat-icon { background: rgba(255, 103, 0, 0.1); color: #FF6700; }
        .card-blue { border-bottom-color: #374050; }
        .card-blue .stat-icon { background: rgba(55, 64, 80, 0.1); color: #374050; }
        .card-green { border-bottom-color: #2ecc71; }
        .card-green .stat-icon { background: rgba(46, 204, 113, 0.1); color: #2ecc71; }

        .btn-logout { background: #ffebe6; color: #d63031; padding: 8px 15px; border-radius: 20px; font-size: 12px; font-weight: 700; text-decoration: none; transition: 0.3s; }
        .btn-logout:hover { background: #d63031; color: #fff; text-decoration: none; }

        /* Table & Form */
        .card-box { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .btn-orange { background: #FF6700; color: #fff; border: none; }
        .btn-orange:hover { background: #e05a00; color: #fff; }
    </style>
</head>
<body></body>