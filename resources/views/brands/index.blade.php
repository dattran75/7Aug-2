<style>
    .pointer {
        cursor: pointer;
    }
</style>
@extends('layout.layout')
@section('menunav')
    <ul class="navbar-nav me-auto mb-2 mb-sm-0">
        <li class="nav-item">
            <a href="#" class="nav-link" id="addBrandBtn">Thêm Thương Hiệu</a>
        </li>
    </ul>
@endsection

@section('main')
    <div class="modal fade" id="BrandModal" tabindex="-1" aria-labelledby="BrandModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="BrandModalLabel">Thêm thương hiệu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" placeholder="Thương hiệu" id="brandname" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="submitBrandBtn">Lưu</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row w-100">
        <div class="col-md-9">
            <div class="table-responsive">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên Thương hiệu</th>
                            <th scope="col">Tình trạng</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($brands) && count($brands) > 0)
                            @foreach ($brands as $key => $item)
                                <tr class="">
                                    <td scope="row">{{ ++$key }}</td>
                                    <td><span class="pointer editBrandName" data-value="{{ $item->name }}"
                                            data-id="{{ $item->id }}">{{ $item->name }}</span></td>
                                    <td>
                                        @if ($item->status == 0 && $item->deleted_at ==null)
                                            <b class="pointer switchBrands" data-id="{{ $item->id }}">Đang khóa</b>
                                        @else
                                            @if ($item->deleted_at!=null)
                                            <b class="pointer restoreBrands" data-id="{{ $item->id }}">Đang xóa</b>
                                            @else
                                            <b class="pointer switchBrands" data-id="{{ $item->id }}">Đang mở</b>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ date('d/m/20y', strtotime($item->created_at)) }}</td>
                                    <td>
                                        <button class="btn btn-danger xoaBrandBtn" data-id="{{ $item->id }}">Xóa</button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        @endif

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter',
                        Swal
                        .stopTimer)
                    toast.addEventListener('mouseleave',
                        Swal
                        .resumeTimer)
                }
            })
            addBrands();
            editBrands();
            deleteBrands();
            restoreBrands();
            SwitchBrands()

        });

        function addBrands() {
            $('#addBrandBtn').click(function(e) {
                e.preventDefault();
                $("#BrandModal").modal('show');
                $("#submitBrandBtn").click(function(e) {
                    e.preventDefault();
                    var name = $("#brandname").val().trim();
                    if (name == '') {
                        Toast.fire({
                            icon: 'error',
                            title: 'Chưa thêm thương hiệu'
                        })
                    } else {
                        $.ajax({
                            type: "post",
                            url: "/products/brands",
                            data: {
                                name: name
                            },
                            dataType: "JSON",
                            success: function(res) {
                                if (res.check == true) {
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Đã thêm thành công'
                                    }).then(() => {
                                        window.location.reload();
                                    })
                                }
                                if (res.msg.name) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: res.msg.name
                                    })
                                }
                            }
                        });
                    }
                });
            });
        }

        function editBrands() {
            $(".editBrandName").click(function(e) {
                e.preventDefault();
                var old = $(this).attr('data-value');
                var id = $(this).attr('data-id');
                $("#brandname").val(old);
                $("#BrandModal").modal('show');
                $("#submitBrandBtn").click(function(e) {
                    e.preventDefault();
                    var name = $("#brandname").val().trim();
                    if (name == '') {
                        Toast.fire({
                            icon: 'error',
                            title: "Tên loại sản phẩm chưa được nhập"
                        })
                    } else if (name == old) {
                        Toast.fire({
                            icon: 'error',
                            title: "Tên loại sản phẩm chưa thay đổi"
                        })
                    } else {
                        $.ajax({
                            type: "post",
                            url: "/products/editBrands",
                            data: {
                                id: id,
                                name: name
                            },
                            dataType: "JSON",
                            success: function(res) {
                                if (res.check == true) {
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Sửa thành công'
                                    }).then(() => {
                                        window.location.reload();
                                    })
                                }
                                if (res.check == false) {
                                    if (res.msg.name) {
                                        Toast.fire({
                                            icon: 'error',
                                            title: res.msg.name
                                        })
                                    } else if (res.msg.id) {
                                        Toast.fire({
                                            icon: 'error',
                                            title: res.msg.id
                                        })
                                    }
                                }
                            }
                        });
                    }
                });
            });
        }


        function deleteBrands() {
            $(".xoaBrandBtn").click(function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                Swal.fire({
                    icon: 'question',
                    text: 'Xóa thương hiệu ?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Đúng',
                    denyButtonText: `Không`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: "  /products/deleteBrands",
                            data: {
                                id: id
                            },
                            dataType: "JSON",
                            success: function(res) {
                                if (res.check == true) {
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Xóa thành công'
                                    }).then(() => {
                                        window.location.reload();
                                    })
                                } else if (res.check == false) {
                                    if (res.msg.id) {
                                        Toast.fire({
                                            icon: 'error',
                                            title: res.msg.id
                                        })
                                    }
                                }
                            }
                        });
                    } else if (result.isDenied) {}
                })
            });
        }

        function restoreBrands() {
            $(".restoreBrands").click(function (e) { 
                e.preventDefault();
                var id = $ (this).attr('data-id');
                Swal.fire({
                    icon:'question',
                    text: 'Khôi phục thương hiệu ?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Đúng',
                    denyButtonText: `Không`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: "/products/restoreBrands",
                            data: {
                                id:id
                            },
                            dataType: "JSON",
                            success: function (res) {
                                if(res.check==true){
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Đã khôi phục'
                                    }).then(()=>{
                                        window.location.reload();
                                    })
                                }
                                if(res.msg.id){
                                    Toast.fire({
                                        icon: 'success',
                                        title: res.msg.id
                                    })
                                }
                            }
                        });
                    } else if (result.isDenied) {
                    }
                })
            });  
        }

        function SwitchBrands() {
            $(".switchBrands").click(function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                Swal.fire({
                    icon: 'question',
                    text: 'Thay đổi trạng thái thương hiệu ?',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Đúng',
                    denyButtonText: `Không`,

                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: "/products/SwitchBrands",
                            data: {
                                id: id
                            },
                            dataType: "JSON",
                            success: function(res) {
                                if (res.check == true) {
                                    Toast.fire({
                                            icon: 'success',
                                            title: 'Đã thay đổi thành công'
                                        })
                                        .then(() => {
                                            window.location.reload();
                                        })
                                } else if (res.check == false) {
                                    if (res.msg.id) {
                                        Toast.fire({
                                            icon: 'error',
                                            title: res.msg.id
                                        })
                                    }
                                }
                            }
                        });
                    } else if (result.isDenied) {}
                })
            });
        } 
       


    </script>
@endsection