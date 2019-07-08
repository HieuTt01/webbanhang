<html>
     <head>
     <?php $this->load->view('admin/head')?>
     </head>

     <body>
          <div id="Left_content">
          <?php $this->load->view('admin/left')?>
          </div>
          <div id="rightSide">
              <?php $this->load->view('admin/header')?>
              <!-- noi dung -->
              <?php $this->load->view($temp,$this->data);?>

              <?php $this->load->view('admin/footer')?>

          </div>
          <div class="clear"></div>
         
     </body>
</html>