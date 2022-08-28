$(function() {
    'use strict'

    $('.sidebar-nav .nav-link.with-sub').on('click', function(e) {
	    e.preventDefault();
	    $(this).parent().toggleClass('show');
	    $(this).parent().siblings().removeClass('show');

	    if (window.matchMedia('(max-width: 991px)').matches) {
	        psNavbar.update();
	    }
	});

	new PerfectScrollbar('.modula-sidebar-body', {
        suppressScrollX: true
    });

	feather.replace();

  	$('[data-toggle="tooltip"]').tooltip();

	if (window.matchMedia('(max-width: 991px)').matches) {
	    const psNavbar = new PerfectScrollbar('#navbarMenu', {
	        suppressScrollX: true
	    });
	}

	$('#modulaMenu').on('click', function(e) {
	    e.preventDefault();

	    $('body').addClass('modula-sidebar-show');

	    $(this).addClass('d-none');
	    $('#mainMenuOpen').removeClass('d-none');
	});

	$(document).on('click touchstart', function(e) {
	    e.stopPropagation();

	    if (!$(e.target).closest('.burger-menu').length) {
	        var sb = $(e.target).closest('.modula-sidebar').length;
	        if (!sb) {
	            $('body').removeClass('modula-sidebar-show');

	            $('#modulaMenu').removeClass('d-none');
	            $('#mainMenuOpen').addClass('d-none');
	        }
	    }
	});

	$('.dropdown-item.trash-product').click(function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');

        var dialogTrash = bootbox.confirm({
            size: 'small',
            animate: false,
            centerVertical: true,
            className: 'trash',
            message: `
            <div class="tx-center pd-t-20">
                <div class="tx-20 tx-semibold mg-b-15">Hapus Produk?</div>
                <div class="tx-17 tx-gray-800 mg-b-10">`+name+`</div>
                <div class="tx-14 tx-gray-600">Penghapusan produk tidak dapat dibatalkan</div>
            </div>`,
            closeButton: false,
            callback: function(result) {
                if(result){
                    Livewire.emit('deleteProduct', id);
                }
            },
            buttons: {
                cancel: {
                    label: "Batal",
                    className: 'btn-sm btn-white'
                },
                confirm: {
                    label: "Hapus",
                    className: 'btn-sm btn-primary'
                }
            }
        });
    });

    window.addEventListener('delete-all', () => {
        $('#trash-all-product').click(function() {
            var dialogTrash = bootbox.confirm({
                size: 'small',
                animate: false,
                centerVertical: true,
                className: 'trash',
                message: `
                <div class="tx-center pd-t-20">
                    <div class="tx-20 tx-semibold mg-b-15">Hapus Produk?</div>
                    <div class="tx-14 tx-gray-600">Penghapusan produk serentak tidak dapat dibatalkan</div>
                </div>`,
                closeButton: false,
                callback: function(result) {
                    if(result){
                        Livewire.emit('deleteAllProduct');
                    }
                },
                buttons: {
                    cancel: {
                        label: "Batal",
                        className: 'btn-sm btn-white'
                    },
                    confirm: {
                        label: "Hapus",
                        className: 'btn-sm btn-primary'
                    }
                }
            });
        });
    })

    
})
