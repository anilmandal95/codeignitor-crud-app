<?= $this->extend('public_layout')?>
<?= $this->section('content')?>
<div class="container">
    <div class="row">
        <div class="col-sm-4 mx-auto">
            <div class="card mt-2 bg-secondary">
                <div class="card-body">
                     <h2>Create new account</h2>
                     <?php $session = session(); ?>
                     <?php if(!is_null($session->getFlashdata('success_message'))) : ?>
                        <div class="alert alert-success">
                        <?= $session->getFlashdata('success_message');?>
                        </div>
                     <?php endif ?>
                        <form id="myform">
                        <div id="message"></div>
                        <div class="mb-2">
                        <label for="username">Name</label><span id="error_name" class="text-danger ms-3"></span>
                        <input type="text" class="form-control" id="name">
                        </div>
                        <div class="mb-2">
                        <label for="username">Email</label><span id="error_email" class="text-danger ms-3"></span>
                        <input type="email" class="form-control" id="email" name="email">    
                        </div>
                        <div class="mb-2">
                        <label for="username">Password</label><span id="error_pass" class="text-danger ms-3"></span>
                        <input type="text" class="form-control" id="pass">    
                        </div>
                        <div class="mb-2">
                        <label for="username">Contact No</label><span id="error_contact" class="text-danger ms-3"></span>
                        <input type="text" class="form-control" id="contact">
                        </div>
                        <div class="mb-2 text-center">
                            <input type="submit" value="Register" id="registerid" 
                            name="register" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection()?>
<?= $this->section('scripts')?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#registerid").click(function(e){
            e.preventDefault();
            if ($.trim($("#name").val()).length == 0 ) {
                error_name = "please enter the name";
                $("#error_name").text(error_name);
            }else{
                error_name = "";
                $("#error_name").text(error_name);
            }
            if ($.trim($("#email").val()).length == 0 ) {
                error_email = "please enter email";
                $("#error_email").text(error_email);
            }else{
                error_email = "";
                $("#error_email").text(error_email);
            }
            if ($.trim($("#pass").val()).length == 0 ) {
                error_pass = "please enter password";
                $("#error_pass").text(error_pass);
            }else{
                error_pass = "";
                $("#error_pass").text(error_pass);
            }
            if ($.trim($("#contact").val()).length == 0 ) {
                error_contact = "please enter contact number";
                $("#error_contact").text(error_contact);
            }else{
                error_contact = "";
                $("#error_contact").text(error_contact);
            }
            //checking and saving data 

        
         if (error_name !='' || error_email !='' || error_pass !='' || error_contact !='') {
            return false;
        }else{
            let name = $("#name").val();
            let email = $("#email").val();
            let password = $("#pass").val();
            let contact = $("#contact").val();
            mydata = {name: name, email: email, password: password, contact: contact};
           console.log(mydata);
             $.ajax({
                url: "user/store",
                method: "POST",
                data: JSON.stringify(mydata),
                success: function(data){
                   msg = "<div class='alert alert-success mt-3'>"+ data.status_message + "</div>";
                   $("#message").html(msg);
                    //for resting form data
                  $("#myform")[0].reset();
                  if(data.status == 200){
                   window.location.replace("getuserdata");
                  }
                },
             });
        }
        
        });
    });
</script>
<?= $this->endSection()?>