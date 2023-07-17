<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>M-Voting</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/main.css'); ?>">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <?php $this->load->view('layoutUser/navbar.php'); ?>
    <!-- Sidebar menu-->
    <?php $this->load->view('layoutUser/sidebar'); ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
            </div>
        </div>

        <?php
        if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php
        }
        ?>

        <?php
        if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
        <?php
        }
        ?>

        <div class="row">

            <?php foreach ($kandidat as $data) : ?>
                <div class="col mt-2">
                    <div class="card mb-5" style="width: 18rem;">
                        <img src="<?= base_url('./gambar/' . $data->foto_kandidat) ?>" class="card-img-top" style="height: 200px;" alt="foto kandidat">
                        <div class="card-body">
                            <h5 class="card-title text-center text-info font-lg text-uppercase"><?= $data->nomor_kandidat; ?></h5>
                            <p class="card-text text-center text-danger font-weight-bold text-uppercase"><?= $data->nama_kandidat; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            <!-- menjalankan controller Utama pada method pilih -->
            <a class="btn btn-primary btn-block btn-lg" href="<?= base_url('utama/pilih'); ?>">Mulai Memilih</a>
        </div>

    </main>
    <?php $this->load->view('layoutUser/bottom'); ?>
</body>

</html>