<?php

require 'function.php';
//menghitung jumlah produk
$h1 = mysqli_query($connect, "select * from produk"); //menghitung total barang yang tersimpan
$h2 = mysqli_num_rows($h1); //jumlah produk
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Detail Barang Masuk</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.php">KASIR</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <!--------------untuk menampilkan menu pilihan -------->
            <div class="sb-sidenav-menu-heading">Menu</div> 
            <a class="nav-link" href="index.php">
              <div class="sb-nav-link-icon"><i class="fas fa-bullhorn"></i></div>
              Order
            </a>
            <a class="nav-link" href="stock.php">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Stock Barang
            </a>
            <a class="nav-link" href="pelanggan.php">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Kelola Pelanggan
            </a>
          </div>
        </div>
        <div class="sb-sidenav-footer">
          <div class="small">Logged in as:</div>
          Start Bootstrap
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-4">Stock Barang</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Welcome</li>
          </ol>
          <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card bg-dark text-white mb-4">
                <div class="card-body">Jumlah Barang: <?= $h2; ?></div>
              </div>
            </div>
          </div>
          <!-- tombol untuk membuka Modal -->
          <button type="button" class="btn btn-secondary mb-4" data-toggle="modal" data-target="#myModal">
            Tambahkan Barang
          </button>
          <!-- modal untuk tabel -->
          <div class="modal fade" id="myModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Tambahkan Barang Baru</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form method="post">

                  <!-- Modal body -->
                  <div class="modal-body">
                    <input type="text" name="namaproduk" class="form-control" placeholder="Nama Produk">
                    <input type="text" name="deskripsi" class="form-control mt-2" placeholder="Deskripsi">
                    <input type="num" name="stock" class="form-control mt-2" placeholder="Stock Awal">
                    <input type="num" name="harga" class="form-control mt-2" placeholder="Harga Produk">
                  </div>
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="tambahbarang">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>

                </form>


              </div>
            </div>
          </div>
          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              Data produk
            </div>
            <div class="card-body">
              <table id="datatablesSimple">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Stock</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  // untuk mengambil data pada database produk
                  $get = mysqli_query($connect, "select * from produk");
                  $i = 1;
                  
                  // untuk menampilkan database produk ke dalam tabel
                  while ($p = mysqli_fetch_array($get)) {
                    $namaproduk = $p['namaproduk'];
                    $deskripsi = $p['deskripsi'];
                    $harga = $p['harga'];
                    $stock = $p['stock'];
                    $idproduk = $p['idproduk'];

                  ?>

                    <tr>
                      <td><?=$i++;?></td> <!-- Perulangan Nomor pada tabel -->
                      <td><?=$namaproduk;?></td> <!--- echo berfungsi untuk menampilkan teks ke layar --->
                      <td><?=$deskripsi;?></td>
                      <td><?=$stock;?></td>
                      <td>Rp<?= number_format($harga); ?></td><!-- number_format untuk pemisah angka nol (decimal parameter) -->
                      <td> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit<?=$idproduk;?>">
                      Edit
                    </button> 
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idproduk;?>">
                      delete
                    </button> 
                    </td>
                    </tr>

                    <!--  Modal untuk tombol edit -->
                    <div class="modal fade" id="edit<?=$idproduk;?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Ubah <?=$namaproduk;?></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>

                          <form method="post"><!--- untuk mengirimkan data secara langsung -->

                            <!-- Modal untuk input produk baru yang ingin di tambahkan -->
                            <div class="modal-body">
                              <input type="text" name="namaproduk" class="form-control" placeholder="Nama Produk" value="<?=$namaproduk;?>">
                              <input type="text" name="deskripsi" class="form-control mt-2" placeholder="Deskripsi" value="<?=$deskripsi;?>">
                              <input type="num" name="stock" class="form-control mt-2" placeholder="Stock" value="<?=$stock;?>">
                              <input type="num" name="harga" class="form-control mt-2" placeholder="harga" value="<?=$harga;?>">
                              <input type="hidden" name="idp" value="<?=$idproduk;?>">
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-success" name="editbarang">Submit</button>
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                          </form>


                        </div>
                      </div>
                    </div>

                    <!-- Modal untuk delete produk -->
                    <div class="modal fade" id="delete<?=$idproduk;?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Hapus<?=$namaproduk;?></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          
                          <form method="post"><!--- untuk mengirimkan data secara langsung --->

                            <!-- Modal body -->
                            <div class="modal-body">
                                ingin menghapus barang ini?
                              <input type="hidden" name="idp" value="<?=$idproduk;?>">
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-success" name="hapusbarang">Submit</button>
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                          </form>


                        </div>
                      </div>
                    </div>

                  <?php
                  } // end of while

                  ?>



                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
          <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your Website 2023</div>
            <div>
              <a href="#">Privacy Policy</a>
              &middot;
              <a href="#">Terms &amp; Conditions</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="assets/demo/chart-area-demo.js"></script>
  <script src="assets/demo/chart-bar-demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
  <script src="js/datatables-simple-demo.js"></script>
</body>

</html>