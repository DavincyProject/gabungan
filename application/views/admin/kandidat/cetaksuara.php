<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Laporan Suara</title>
</head>

<body onload="window.print()">
    <div class="container py-5">
        <h1 class="text-center">Laporan Data Perhitungan Suara</h1>
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nomor Kandidat</th>
                                <th>Perolehan Suara</th>
                                <th>Persentase Suara</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kandidat as $data) : ?>
                                <?php
                                $cek = $this->db->get_where('pilih', array('id_kandidat' => $data->id_kandidat))->num_rows();

                                if ($cek != 0) {
                                    $suara = ($cek / $pilih) * 100;
                                } else {
                                    $suara = 0;
                                }
                                ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $data->nama_kandidat; ?></td>
                                    <td><?= $data->nomor_kandidat; ?></td>
                                    <td><?= $cek; ?></td>
                                    <td><?= $suara . "%"; ?></td>
                                </tr>
                            <?php $no++;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>