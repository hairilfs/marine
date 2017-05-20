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
          <a class="navbar-brand" href="{{ URL::to('/') }}" style="padding-top:5px;">
            <img src="{{ asset('/content/img/mi.png') }}" height="35"/> 
          </a>
          <a class="navbar-brand" style="padding-left: 0px;" href="{{ URL::to('/') }}">Marine Inspector</a>
        </div>
        <!-- /.navbar-header -->
        <ul class="nav navbar-top-links navbar-right">
          <?php
            if(Auth::check()){

              if(Auth::user()->roles->is_admin){
          ?>

          <li>
            <a href="{{ URL::to('employee_profile') }}"><i class="fa fa-gear fa-fw"></i> Manage Marine Inspector</a>
          </li>

          <?php
              } 
          ?>

          <li>
            <a href="#" data-toggle="modal" data-target="#choose-theme"><i class="fa fa-picture-o fa-fw"></i> Choose Theme</a>
          </li>
          <li>
            <a href="#"><i class="fa fa-envelope-o fa-fw"></i> Message <span class="badge">3</span></a>
          </li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              Hi {{ Auth::user()->employee_profile != null? Auth::user()->employee_profile->name : Auth::user()->username}}
              <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
              <li><a href="{{ URL::to('employee_profile/edit_profile') }}"><i class="fa fa-user fa-fw"></i> Profile</a>
              </li>            
              <li><a href="{{ URL::to('user/reset_password') }}"><i class="fa fa-lock fa-fw"></i> Change Password</a>
              </li>            
              <li class="divider"></li>
              <li>
                <a href="{{ URL::to('auth/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
              </li>
            </ul>
            <!-- /.dropdown-user -->
          </li>

          <?php
          } else {
          ?>

          <li>
            <a href="#" data-toggle="modal" data-target="#choose-theme"><i class="fa fa-picture-o fa-fw"></i> Choose Theme</ a>
          </employee_profile>
          <li>
            <a href="{{ URL::to('auth/login') }}"><i class="fa fa-sign-in fa-fw"></i> Login</a>
          </li>
          
          <?php
          }
          ?>

          </ul>
        <!-- /.navbar-static-side -->
      </nav>
    <?php
      if(Auth::check()){

        if(Auth::user()->roles->is_admin){
    ?>
    <!-- /.navbar-top-links -->
    <div class="navbar-default navbar-static-side" role="navigation">
      <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
          <li>
            <a href="#"><img class="fa" src="{{ asset('/content/img/user.png') }}" height="15"/>&nbsp;User Management<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a  href="{{ URL::to('/user') }}" >User Access</a>
              </li>
            </ul>
          </li>
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
                    <a  href="{{ URL::to('/emp_grade') }}" >Pangkat &amp; Golongan</a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="#">Wilayah Kerja<span class="fa arrow"></span></a>
                <ul class="nav nav-third-level">
                  <li>
                    <a  href="{{ URL::to('/harbour_area') }}" >Wilayah Kerja</a>
                  </li>
                  <li>
                    <a  href="{{ URL::to('/harbour_head') }}">Kordinator Wilayah Kerja</a>
                  </li>
                  <li>
                    <a  href="{{ URL::to('/harbour_master') }}" >Unit Kerja</a>
                  </li>
                  <li>
                    <a  href="{{ URL::to('/harbour_grade') }}" >Kelas Unit Kerja</a>
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
                  <li>
                    <a  href="{{ URL::to('/training_type') }}" >Jenis Diklat &amp  Training</a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="#">Dokumen<span class="fa arrow"></span></a>
                <ul class="nav nav-third-level">
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
            <a href="#"><img class="fa" src="{{ asset('/content/img/mi.png') }}" height="15"/>&nbsp;Laporan <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a href="#">Laporan Data Marine<span class="fa arrow"></span></a>

                <ul class="nav nav-third-level">
                  <li>
                    <a  href="{{ URL::to('/employee_profile') }}" >Data Marine Inspector</a>
                  </li>
                  <li>
                    <a  href="{{ URL::to('/employee_profile/filter_by_education') }}" >Berdasarkan Pendidikan</a>
                  </li>
                  <li>
                    <a  href="{{ URL::to('/employee_profile/filter_by_mi_date') }}" >Berdasarkan Tahun Pengukuhan</a>
                  </li>
                  <li>
                    <a  href="{{ URL::to('/employee_profile/filter_by_graduate_date') }}" >Berdasarkan Tahun Kelulusan</a>
                  </li>
                  <li>
                    <a  href="{{ URL::to('/employee_profile/filter_by_harbour') }}" >Berdasarkan Penempatan</a>
                  </li>
                </ul>

            <ul class="nav nav-second-level">
              <li>
                <a href="#">Laporan Kompetensi<span class="fa arrow"></span></a>
              </li>
            </ul>
            <ul class="nav nav-second-level">
              <li>
                <a href="#">Laporan Pendidikan<span class="fa arrow"></span></a>
              </li>
            </ul>
            <ul class="nav nav-second-level">
              <li>
                <a href="#">Laporan Pemeriksaan<span class="fa arrow"></span></a>
                <ul class="nav nav-third-level">
                  <li>
                    <a  href="#" >Laporan Perusahaan Pelayaran</a>
                  </li>
                  <li>
                    <a  href="#" >Laporan Pemeriksaan Kapal</a>
                  </li>
                  <li>
                    <a  href="#" >Laporan Sertifikasi</a>
                  </li>
                </ul>

              </li>
            </ul>
            <ul class="nav nav-second-level">
              <li>
                <a href="#">Laporan<span class="fa arrow"></span></a>
              </li>
            </ul>



            </li>
            </ul>

          </li>
          <li>
            <a href="#"><img class="fa" src="{{ asset('/content/img/check.png') }}" height="15"/>&nbsp;Pemeriksaan<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a  href="{{ URL::to('/shipping_task') }}">Shipping Task</a>
              </li>
              <li>
                <a  href="{{ URL::to('/vessel') }}">Vessel</a>
              </li>
              <li>
                <a  href="{{ URL::to('/certificate_task_shipping') }}">Certificate</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#"><img class="fa" src="{{ asset('/content/img/map.ico') }}" height="15"/>&nbsp;Peta Marine Inspector<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a  href="{{ URL::to('/map/manage') }}" >Kelola</a>
              </li>
              <li>
                <a  href="{{ URL::to('/map') }}" >Peta</a>
              </li>
            </ul>
          </li>
{{--           <li>
            <a  href="{{ URL::to('/document_explorer') }}">
            <img class="fa" src="{{ asset('/content/img/doc.png') }}" height="15"/>&nbsp;</i>Regulasi</a>
          </li> --}}
{{--           <li>
            <a  href="{{ URL::to('/map') }}">
            <img class="fa" src="{{ asset('/content/img/map.ico') }}" height="15"/>&nbsp;</i>Peta Marine Inspector</a>
          </li> --}}
          <li>
            <a  href="{{ URL::to('/messages') }}">
            <img class="fa" src="{{ asset('/content/img/message.png') }}" height="15"/>&nbsp;Forum</a>
          </li>
        </ul>
      </div>
      <!-- /.sidebar-collapse -->

      <div id="tree_directory"></div>
      <br>      

    </div>

    <?php
        } else {

    ?>

    <!-- /.navbar-top-links -->
    <div class="navbar-default navbar-static-side" role="navigation">
      <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
          <li>
            <a  href="{{ URL::to('/employee_profile/list_only') }}">
            <img class="fa" src="{{ asset('/content/img/mi.png') }}" height="15"/>&nbsp;</i>Data Marine Inspector</a>
          </li>
          <li>
            <a  href="{{ URL::to('/map/map_user') }}">
            <img class="fa" src="{{ asset('/content/img/map.ico') }}" height="15"/>&nbsp;</i>Peta Marine Inspector</a>
          </li>
          <li>
            <a  href="{{ URL::to('/messages/user') }}">
            <img class="fa" src="{{ asset('/content/img/message.png') }}" height="15"/>&nbsp;</i>Forum</a>
          </li>
        </ul>
      </div>
      <!-- /.sidebar-collapse -->

      <div id="tree_directory"></div>
      <br>    
    </div>

    <?php

        }
      }
    ?>

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
                <a href="#" data-theme="ocean" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/sb-admin/images/themes/skin-ocean.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="blue" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/sb-admin/images/themes/skin-blue.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="chrome" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/sb-admin/images/themes/skin-chrome.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="city" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/sb-admin/images/themes/skin-city.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="greenish" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/sb-admin/images/themes/skin-greenish.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="kiwi" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/sb-admin/images/themes/skin-kiwi.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="lights" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/sb-admin/images/themes/skin-lights.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="nexus" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/sb-admin/images/themes/skin-nexus.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="night" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/sb-admin/images/themes/skin-night.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="sunny" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/sb-admin/images/themes/skin-sunny.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="sunset" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/sb-admin/images/themes/skin-sunset.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="violate" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/sb-admin/images/themes/skin-violate.jpg') }});"></div></a>
              </div>
              <div class="col-sm-4">
                <a href="#" data-theme="yellow" class="themebox"><div class="bg" style="background-image:url({{ asset('/content/sb-admin/images/themes/skin-yellow.jpg') }});"></div></a>
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

<link href="{{ asset('/content/dhtmlxTree_v45/codebase/dhtmlxtree.css') }}" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{{ asset('/content/dhtmlxTree_v45/codebase/dhtmlxtree.js') }}"></script>

<style type="text/css">
  #tree_directory {
    /*width:25%; */
    width: 100%;
    max-width:250px; 
    height:90%;
    min-height:400px;
    border :1px solid Silver;
    background: rgba(0,0,0,0.3);
    color:#ddd;

  }
</style>
<script type="text/javascript">

    <?php
      if(Auth::check()){
        if(Auth::user()->roles->is_admin){
    ?>

      var url_target = "{{ URL::to('document_explorer/') }}";

    <?php } else { ?>

      var url_target = "{{ URL::to('document_explorer/browse_only/') }}";

    <?php
        }
      }
    ?>

    $(document).ready(function(){

      $("body").onload = load_tree();

    });

  
    var myMenu, myTree;
    function load_tree(){
      var im0 = "doc.gif"; // the icon for a leaf node
      var im1 = "opened.gif"; // the icon for an expanded parent node
      var im2 = "closed.gif"; // the icon for a collapsed parent node
      var img_dir = "{{ asset('/content/dhtmlxTree_v45/skins/web/imgs/dhxtree_web/') }}" + "/";
      myTree = new dhtmlXTreeObject("tree_directory","100%","100%",0);
      myTree.setImagePath(img_dir );
      // myTree.setImagePath("/dhtmlxTree_v45/skins/web/imgs/dhxtree_web/" );
      // tree.setItemImage(itemId,image1,image2);
      myTree.enableSmartXMLParsing(true);
      myTree.enableDragAndDrop(false);
      myTree.setOnClickHandler(tree_onClick);
      myTree.setOnCheckHandler(tree_onCheck);
      myTree.setOnDblClickHandler(tree_onDoubleClick);
      myTree.load("{{ URL::to('document_explorer/get/tree') }}");

    }

    function tree_onClick (id) {
      // body...
      // alert(id);
      url_target = url_target + "/" + id;
      window.location = url_target;
    }

    function tree_onCheck (id) {
      // body...
    }

    function tree_onDoubleClick (id) {
      // body...
    }

    function onButtonClick(menuitemId,type){
      var id = myTree.contextID;
      myTree.setItemColor(id,menuitemId.split("_")[1]);
    }


</script>
@yield('javascript')
</body>
</html>