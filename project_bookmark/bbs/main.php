<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>main</title>
    <?php require_once("../common/html_header.php"); ?>
    <?php require_once("index.php"); ?>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

  <!-- side bar -->
  <?php require_once("../common/side_bar.php"); ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

      <!-- Topbar -->
      <?php require_once("../common/Top_bar.php"); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">최신순</h1>

            <!-- create -->
            <div class="col-md-4 col-md-offset-4">
             <input type="text" id="main_url" name="main_url" class="form-control" value="https://" required>
            </div>
             <button type="button" id ="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm url-title" 
               data-toggle="modal" data-target="#modal_create" data-title="Test Title">등록</button>
          </div>
          <?php require_once("modal_create.php"); ?>
          
          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-6 col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">최근 등록한 북마크</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                <table class="table table-hover" style="color:black;">
                    <thead>
                        <tr>
                         <th scope="col"></th>
                         <th scope="col">first</th>
                         <th scope="col">Last</th>
                         <th scope="col">Handle</th>
                         <th></th>
                         <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($boards as $key => $board): ?>
                        <tr>
                         <th scope="row"><?= ++$key; ?></th>
                         <td><?= $board->title; ?></td>
                         <td><?= $board->url; ?></td>
                         <td><?= $board->Regtime; ?></td>
                         <td><?= $board->Hists; ?></td>
                         <td>
                            <!-- <a href="edit.php?id=<?= $board->id ?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a> -->
                            <button class="btn btn-info edit_data" data-toggle="modal" data-target="#modal_edit" id="<?= $board->id; ?>"><i class="fas fa-pencil-alt"></i></button>
                            <?php require_once("modal_edit.php"); ?>
                            <a href="delete.php?id=<?= $board->id ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                         </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    </table>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-6 col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">최근 방문한 북마크</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Direct
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Social
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Referral
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- footer_js -->
  <?php require_once("../common/footer_js.php"); ?>
</body>

</html>
