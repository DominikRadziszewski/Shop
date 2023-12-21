$(function()
{ 
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $('div.products-count a').on("click",function(event){
        event.preventDefault();
        $('a.products-actual-count').text($(this).text());
        getProducts($(this).text());
    });

    $('a#filter-button').on("click", function(event){
        event.preventDefault();
        getProducts($('a.products-actual-count').first().text());
     });

     $('button.add-cart-button').on("click", function (event) {
        event.preventDefault();
    
        $.ajax({
            method: "POST",
            url: WELCOME_DATA.addToCart + $(this).data('id'),
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })
            .done(function (response) {
                Swal.fire({
                    title: "Brawo",
                    text:"Produkt został dodany do koszyka",
                    icon: "success",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: '<i class="fas fa-cart-plus"></i> Przejdz do koszyka',
                    cancelButtonText: '<i class="fas fa-shopping-bag"></i> Kontunuj zakupy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location=WELCOME_DATA.listCart;                  
                     } 
                });
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                var responseJSON = JSON.parse(jqXHR.responseText);
                console.log(responseJSON.message);
                Swal.fire({
                    title: responseJSON.status,
                    text: responseJSON.message,
                    icon: "error",
                });
            });
    });

              

        function getProducts(paginate){
            const form =$('form.sidebar-filter').serialize();
        $.ajax({
            method: "GET",
            url: "/",
            data: form + "&" +$.param({paginate: paginate}),
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
            })
            .done(function(response) {
                    $('div#products-wrapper').empty();
                     
                    $.each(response.data, function(index, product){
                        const html = '<div class="col-6 col-md-6 col-lg-4 mb-3">' +
                         '<div class="card h-100 border-0">' +
                             '<div class="card-img-top">'+
                              '<img src="'+ getImage(product) +'" style="height: 240px; width: 240px;" class="img-fluid mx-auto d-block" alt="Zdjęcie produktu">'+
                             ' </div>' +
                             '<div class="card-body text-center">' +
                                 '<h4 class="card-title">'+
                                     product.name +
                                 '</h4>'+
                                 '<h5 class="card-price small text-warning">'+
                                         '<i>PLN' +product.price +'</i>'+
                                             '</h5>'+
                                     '</div>'+'<button class="btn btn-success btn-sm add-cart-button"' + GetDisabled() + ' data-id= '+ product.id +' ><i class="fa-solid fa-cart-plus"></i>'+
                                     'Dodaj do koszyka'+
                                    '</button>'+
                                 '</div>'+
                             '</div>';
                             $('div#products-wrapper').append(html);
     
                     });
                    })
            .fail(function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseJSON.message);
            });
        };
        
        function getImage(product){
            if(!!product.image_path)
            {
                return WELCOME_DATA.storagePath+product.image_path;
            }
            return WELCOME_DATA.defaultImage
        }
        function GetDisabled(){
            if (WELCOME_DATA.isGuest){
                return 'disabled';
            }
            return '';
        }
});

