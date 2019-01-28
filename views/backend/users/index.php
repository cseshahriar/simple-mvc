<?php require_once 'views/backend/inc/header.php'; ?> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users Informations
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/user/index">Users</a></li> 
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Users List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Photo</th>
                  <th>Created At</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <!-- loop -->
                  <?php foreach($data['users'] as $user) : ?>
                <tr>
                  <td><?= $user->id ?></td>
                  <td><?= $user->name ?></td>
                  <td><?= $user->email ?></td>
                  <td>
                    <img src="<?= asset('/uploads/users/'.$user->photo); ?>"  alt="" style="height:30px">
                  </td> 
                  <td><?= $user->created_at ?></td> 
                  <td>
                    <!-- edit -->
                    <form action="/user/edit" style="display: inline;margin: 0;padding: 0" method="post">
                      <input type="hidden" name="id" value="<?= $user->id ?>"> 
                      <button type="submit" style="border:0;background:none" onclick="return confirm('Are you sure want to edit it?');">
                        <i class="fa fa-pencil-square"></i>   
                      </button>     
                    </form>    

                    <!-- delete -->
                    <form action="/user/delete" style="display: inline;margin: 0;padding: 0" method="post">    <input type="hidden" name="id" value="<?= $user->id ?>">
                        <button type="submit" style="border:0;background:none" onclick="return confirm('Are you sure want to delete it?');"> 
                          <i class="fa fa-trash"></i>  
                        </button>     
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
                <!-- / loop -->
                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Photo</th>
                  <th>Created At</th>
                  <th>Actions</th>  
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper --> 
  <?php require_once 'views/backend/inc/footer.php'; ?> 