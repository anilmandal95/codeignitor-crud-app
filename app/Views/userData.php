<?= $this->extend('public_layout')?>
<?= $this->section('content')?> 

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User update</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <input type="text" class="form-control" id="id" hidden>
      <div class="mb-2">
        <label for="username">Name</label><span id="error_name" class="text-danger ms-3"></span>
        <input type="text" class="form-control" id="name">
      </div>
      <div class="mb-2">
          <label for="username">Email</label><span id="error_email" class="text-danger ms-3"></span>
          <input type="email" class="form-control" id="email">    
     </div>
    <div class="mb-2">
    <label for="username">Password</label><span id="error_pass" class="text-danger ms-3"></span>
    <input type="text" class="form-control" id="pass">    
   </div>
   <div class="mb-2">
     <label for="username">Contact No</label><span id="error_contact" class="text-danger ms-3"></span>
    <input type="text" class="form-control" id="contact">
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary update-user">Update</button>
      </div>
    </div>
  </div>
</div>
<div class="col-sm-12 text-center">
      <h3 class="alert alert-info p-2">   
        Show User Information
      </h3>
      <div id="delupdmsg"></div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Password</th>
            <th scope="col">Contact</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="tbody"></tbody>
      </table>
</div>

<?= $this->endSection()?>
<?= $this->section('scripts')?>
<script type="text/javascript">
$(document).ready(function(){
  // ajax request to show user data
function showData(){
    output = "";
    $.ajax({
        url: "user/get",
        dataType: "json",
        method: "POST",
        success:function(data){
            //console.log(data.users);
            if (data) {
                x = data.users;
            }else{
                x = "";
            }
             for (i = 0; i < x.length; i++) {
               console.log(x[i]);
                console.log(x[i].name);
                output += "<tr><td>"+ x[i].id + "</td><td>" + x[i].name +
                 "</td><td>" + x[i].email + 
                 "</td><td>" + x[i].password + 
                 "</td><td>" + x[i].contact + 
                 "</td><td><button class='btn btn-warning btn-sm btn-edit' data-bs-toggle='modal' data-bs-target='#editModal' data-sid="+ 
                 x[i].id +">Edit</button><button class='btn btn-danger btn-sm btn-del' data-sid="+ 
                 x[i].id +">Delete</button></td></tr>";
             }
             $("#tbody").html(output);
        }
    });
  }
//ajax request for deleting data
$("tbody").on("click", ".btn-del", function(){
 let id = $(this).attr("data-sid");
console.log(id);
  mydata = { sid : id };
  mythis = this;
  $.ajax({
      url: "user/delete",
      method: "POST",
      data: JSON.stringify(mydata),
      success: function(data){
            console.log(data.status);
          if (data.status == 200) {
              msg = "<div class='alert alert-danger mt-3'>User Record deleted successfully</div>";
              $(mythis).closest("tr").fadeOut();
          }else{
              msg = "<div class='alert alert-success mt-3'>Failed to delete</div>";
          }
         $("#delupdmsg").html(msg);
      },
  });

});

//ajax request for editing data
$("tbody").on("click", ".btn-edit", function(){
   //console.log("edit button clicked");
    let id = $(this).attr("data-sid");
    console.log(id);
   mydata = { sid : id };
   mythis = this;
   $.ajax({
       url: "user/edit",
       method: "POST",
       dataType: "json",
       data: JSON.stringify(mydata),
        success: function(data){
          console.log(data);
          $("#id").val(data.id);
           $("#name").val(data.name);
           $("#email").val(data.email);
           $("#pass").val(data.password);
           $("#contact").val(data.contact);
     },
     });
});


$(document).on("click", ".update-user", function(){
   console.log("edit button from model clicked");
   let id = $("#id").val();
   let name = $("#name").val();
   let email = $("#email").val();
   let password = $("#pass").val();
   let contact = $("#contact").val();
   mydata = {id: id, name: name, email: email, password: password, contact: contact};
   console.log(mydata);
    $.ajax({
       url: "user/update",
       method: "POST",
       data: JSON.stringify(mydata),
       success: function(data){
        $("#editModal").modal("hide");
        $("#tbody").html("");
        showData();
        if (data.status == 200) {
              msg = "<div class='alert alert-success mt-3'>User Record updated successfully</div>";
              $(mythis).closest("tr").fadeOut();
          }else{
              msg = "<div class='alert alert-success mt-3'>Failed to delete</div>";
          }
         $("#delupdmsg").html(msg);
       }
     });
});








 showData()
});
       
</script>
<?= $this->endSection()?>
