<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--/ No cache -->
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    
    @yield('meta_csrf')
    <title>Marine Inspector </title>
    <link href="{{ asset('/content/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/content/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/content/css/main.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/content/parsley/parsley.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/content/datepicker/datepicker3.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/content/sb-admin/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css">
    <!-- <link href="{{ asset('/content/sb-admin/datatables/media/css/jquery.dataTables.css') }}" rel="stylesheet" type="text/css"> -->
    <!-- MetisMenu CSS -->
    <link href="{{ asset('/content/sb-admin/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
    <link href="{{ asset('/content/sb-admin/css/sb-admin-2.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('/content/jquery/jquery-2.1.1.min.js') }}"></script>
  </head>
  <body>
    <div id="wrapper">
      <!-- Navigation -->
      <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.html" style="padding-top:5px;">
            <img src="{{ asset('/content/img/ntr_marine_inspector.gif') }}" height="35"/>
          </a>
          <a class="navbar-brand" href="{{ URL::to('/') }}">Data Marine Inspector</a>
        </div>
        <!-- /.navbar-header -->
        <ul class="nav navbar-top-links navbar-right">
          <?php if(false) { ?>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-messages">
              <li>
                <a href="#">
                  <div>
                    <strong>John Smith</strong>
                    <span class="pull-right text-muted">
                    <em>Yesterday</em>
                    </span>
                  </div>
                  <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="#">
                  <div>
                    <strong>John Smith</strong>
                    <span class="pull-right text-muted">
                    <em>Yesterday</em>
                    </span>
                  </div>
                  <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="#">
                  <div>
                    <strong>John Smith</strong>
                    <span class="pull-right text-muted">
                    <em>Yesterday</em>
                    </span>
                  </div>
                  <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a class="text-center" href="#">
                  <strong>Read All Messages</strong>
                  <i class="fa fa-angle-right"></i>
                </a>
              </li>
            </ul>
            <!-- /.dropdown-messages -->
          </li>
          <!-- /.dropdown -->
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-tasks">
              <li>
                <a href="#">
                  <div>
                    <p>
                    <strong>Task 1</strong>
                    <span class="pull-right text-muted">40% Complete</span>
                    </p>
                    <div class="progress progress-striped active">
                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                        <span class="sr-only">40% Complete (success)</span>
                      </div>
                    </div>
                  </div>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="#">
                  <div>
                    <p>
                    <strong>Task 2</strong>
                    <span class="pull-right text-muted">20% Complete</span>
                    </p>
                    <div class="progress progress-striped active">
                      <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                        <span class="sr-only">20% Complete</span>
                      </div>
                    </div>
                  </div>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="#">
                  <div>
                    <p>
                    <strong>Task 3</strong>
                    <span class="pull-right text-muted">60% Complete</span>
                    </p>
                    <div class="progress progress-striped active">
                      <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                        <span class="sr-only">60% Complete (warning)</span>
                      </div>
                    </div>
                  </div>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="#">
                  <div>
                    <p>
                    <strong>Task 4</strong>
                    <span class="pull-right text-muted">80% Complete</span>
                    </p>
                    <div class="progress progress-striped active">
                      <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                        <span class="sr-only">80% Complete (danger)</span>
                      </div>
                    </div>
                  </div>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a class="text-center" href="#">
                  <strong>See All Tasks</strong>
                  <i class="fa fa-angle-right"></i>
                </a>
              </li>
            </ul>
            <!-- /.dropdown-tasks -->
          </li>
          <!-- /.dropdown -->
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
              <li>
                <a href="#">
                  <div>
                    <i class="fa fa-comment fa-fw"></i> New Comment
                    <span class="pull-right text-muted small">4 minutes ago</span>
                  </div>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="#">
                  <div>
                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                    <span class="pull-right text-muted small">12 minutes ago</span>
                  </div>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="#">
                  <div>
                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                    <span class="pull-right text-muted small">4 minutes ago</span>
                  </div>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="#">
                  <div>
                    <i class="fa fa-tasks fa-fw"></i> New Task
                    <span class="pull-right text-muted small">4 minutes ago</span>
                  </div>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="#">
                  <div>
                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                    <span class="pull-right text-muted small">4 minutes ago</span>
                  </div>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a class="text-center" href="#">
                  <strong>See All Alerts</strong>
                  <i class="fa fa-angle-right"></i>
                </a>
              </li>
            </ul>
            <!-- /.dropdown-alerts -->
          </li>
          <!-- /.dropdown -->
          <?php } ?>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
              <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
            </li>
            <li class="divider"></li>
            <li><a href="{{ URL::to('/auth/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
          </li>
        </ul>
        <!-- /.dropdown-user -->
      </li>
      <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
    <div class="navbar-default sidebar" role="navigation">
      <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
          <li>
            <a href="#"><img class="fa" src="{{ asset('/content/img/database_check.png') }}" height="15"/>&nbsp;Master Data<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a href="#">Jabatan<span class="fa arrow"></span></a>
                <ul class="nav nav-third-level">
                  <li>
                    <a  href="{{ URL::to('/functional_title') }}" >Jabatan Fungsional</a>
                  </li>
                  <li>
                    <a  href="{{ URL::to('/structural_title') }}" >Jabatan Struktural</a>
                  </li>
                  <li>
                    <a  href="{{ URL::to('/training_type') }}" >Jenis Diklat &amp  Training</a>
                  </li>
                  <li>
                    <a  href="{{ URL::to('/emp_grade') }}" >Pangkat & Golongan</a>
                  </li>
                </ul>
              </li>
              
              <!--                               <li>
                <a href="#">Unit Kerja<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                      <li>
                        <a  href="{{ URL::to('/m_unit_kerja') }}" >Unit Kerja</a>
                      </li>
                      <li>
                        <a  href="{{ URL::to('/m_unit_kerja_kelas') }}" >Kelas Unit Kerja</a>
                      </li>
                                </ul>
              </li> -->
              <li>
                <a href="#">Wilayah Kerja<span class="fa arrow"></span></a>
                <ul class="nav nav-third-level">
                  <li>
                    <a  href="{{ URL::to('/harbour_master') }}" >Wilayah Kerja</a>
                  </li>
                  <li>
                    <a  href="{{ URL::to('/harbour_area') }}">Kordinator Wilayah Kerja</a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="#">Pendidikan<span class="fa arrow"></span></a>
                <ul class="nav nav-third-level">
                  <li>
                    <a  href="{{ URL::to('/university') }}" >Universitas</a>
                  </li>
                  <li>
                    <a  href="{{ URL::to('/faculty') }}" >Fakultas</a>
                  </li>
                  <li>
                    <a  href="{{ URL::to('/major') }}" >Jurusan</a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="#">Dokumen<span class="fa arrow"></span></a>
                <ul class="nav nav-third-level">
                  <li>
                    <a  href="{{ URL::to('/home/error_404') }}" >Dokumen</a>
                  </li>
                  <li>
                    <a  href="{{ URL::to('/doc_type') }}">Tipe Dokumen</a>
                  </li>
                </ul>
              </li>
              <li>
                <a  href="{{ URL::to('/shipping_company') }}" >Perusahaan Shipping</a>
              </li>
            </ul>
            <!-- /.nav-second-level -->
          </li>
          <li>
            <a href="#"><img class="fa" src="{{ asset('/content/img/ntr_marine_inspector.gif') }}" height="15"/>&nbsp;</i>Marine Inspector<span class="fa arrow"></span></a>
            <ul class="nav nav-third-level">
              <li>
                <a  href="{{ URL::to('/employee_profile') }}" >Data Marine Inspector</a>
              </li>
              <li>
                <a  href="{{ URL::to('/employee_profile/filter_by_mi_date') }}" >Berdasarkan Tahun Pengukuhan</a>
              </li>
              <li>
                <a  href="{{ URL::to('/employee_profile/filter_by_graduate_date') }}" >Berdasarkan Tahun Kelulusan</a>
              </li>
              <li>
                <a  href="{{ URL::to('/employee_profile/filter_by_harbour_area') }}" >Berdasarkan Penempatan</a>
              </li>
            </ul>
          </li>
          <li>
            <a  href="{{ URL::to('/home/error_404') }}">
            <img class="fa" src="{{ asset('/content/img/laporan.gif') }}" height="15"/>&nbsp;</i>Peta</a>
          </li>
          <li>
            <a  href="{{ URL::to('/home/error_404') }}">
            <img class="fa" src="{{ asset('/content/img/laporan.gif') }}" height="15"/>&nbsp;</i>Laporan Kinerja</a>
          </li>
          <li>
            <a  href="{{ URL::to('/document_explorer') }}">
            <img class="fa" src="{{ asset('/content/img/ntr_marine_inspector.gif') }}" height="15"/>&nbsp;</i>Dokumen Regulasi</a>
          </li>
        </ul>
      </div>
      <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
  </nav>
  <div id="page-wrapper">
    <div class="row" style="padding-top:10px;">
      @yield('content')
    </div>
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- CHOOSE THEME MODAL -->
<div class="modal fade" id="choose-theme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Choose Theme</h4>
          </div>  
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-4">
                <a href="#" data-theme="ocean" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/images/themes/skin-ocean.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="blue" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/images/themes/skin-blue.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="chrome" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/images/themes/skin-chrome.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="city" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/images/themes/skin-city.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="greenish" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/images/themes/skin-greenish.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="kiwi" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/images/themes/skin-kiwi.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="lights" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/images/themes/skin-lights.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="nexus" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/images/themes/skin-nexus.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="night" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/images/themes/skin-night.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="sunny" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/images/themes/skin-sunny.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="sunset" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/images/themes/skin-sunset.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="violate" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/images/themes/skin-violate.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="yellow" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/images/themes/skin-yellow.jpg') }});"></div></a>
              </div>
            </div>
          </div>
      </div>
    </div>
</div>

<!--[if lt IE 9]>
<script type="text/javascript" src="{{ asset('/content/asset/js/html5shiv.js') }}"></script>
<![endif]-->
<script type="text/javascript" src="{{ asset('/content/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/content/js/holder.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/content/parsley/i18n/id.js') }}"></script>
<script type="text/javascript" src="{{ asset('/content/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/content/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/content/datepicker/locales/bootstrap-datepicker.id.js') }}"></script>
<!-- <script type="text/javascript" src="{{ asset('/content/sb-admin/datatables/media/js/jquery.js') }}"></script> -->
<script type="text/javascript" src="{{ asset('/content/sb-admin/datatables/media/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ asset('/content/sb-admin/datatables-plugins/api/fnFilterAll.js') }}"></script>
<script type="text/javascript" src="{{ asset('/content/sb-admin/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js') }}"></script>
<!-- Metis Menu Plugin JavaScript -->
<script type="text/javascript" src="{{ asset('/content/sb-admin/metisMenu/dist/metisMenu.min.js') }}"></script>
<!-- Custom Theme JavaScript -->
<script type="text/javascript" src="{{ asset('/content/sb-admin/js/sb-admin-2.js') }}"></script>
<script type="text/javascript">
var base_url = "{{ URL::to('/') }}";
</script>
<script type="text/javascript" src="{{ asset('/content/js/app.js') }}"></script>
@yield('javascript')
</body>
</html>