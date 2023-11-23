$(function(){
    $(".delete").on("click",function(){ 
      Swal.fire({
        title: confirmDelete,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Tak",
        cancelButtonText:"Nie"
                }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
        method: "delete",
        url: deleteUrl+$(this).data("id")
                })
        .then(
          function(response) {
            location.reload();
            Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
                    });
                            },
        function(jqXHR, textStatus, errorThrown) {
          var responseJSON = JSON.parse(jqXHR.responseText);
          console.log(responseJSON.message);
          Swal.fire({
        title: responseJSON.status,
          text: responseJSON.message,
          icon: "error",
                  });
                                                }
              );

      
                            };
    
                                    });
      
  });
});
