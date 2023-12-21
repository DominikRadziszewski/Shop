$(function () {
  $(".delete").on("click", function () {
      Swal.fire({
          title: confirmDelete,
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Tak",
          cancelButtonText: "Nie"
      }).then((result) => {
          if (result.isConfirmed) {
              // Pobierz CSRF token z tagu meta
              var csrfToken = $('meta[name="csrf-token"]').attr('content');

              // Dodaj CSRF token do nagłówków żądania AJAX
              $.ajax({
                  method: "delete",
                  url: deleteUrl + $(this).data("id"),
                  headers: {
                      'X-CSRF-TOKEN': csrfToken
                  }
              }).then(
                  function (response) {
                      location.reload();
                  },
                  function (jqXHR, textStatus, errorThrown) {
                      var responseJSON = JSON.parse(jqXHR.responseText);
                      console.log(responseJSON.message);
                      Swal.fire({
                          title: responseJSON.status,
                          text: responseJSON.message,
                          icon: "error",
                      });
                  }
              );
          }
      });
  });
});