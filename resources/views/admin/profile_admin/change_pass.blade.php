@extends('admin.profile_admin.profile')

@section('content-change')

    <div class="col-md-9">

        @if(session()->has('message_error_pass_old'))
            <div class="alert alert-danger">
                {{ session()->get('message_error_pass_old') }}
            </div>
        @endif

        @if(session()->has('message_error_pass_old_comfirm'))
            <div class="alert alert-danger">
                {{ session()->get('message_error_pass_old_comfirm') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#" data-toggle="tab">Đổi mật khẩu</a></li>
                </ul>
            </div>
            <div class="card-body">

                <form action="{{ url('update-change-password/'.$user_ids->id) }}" method="post" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group col-md-6">
                        <label for="">Mật khẩu cũ:</label>
                        <input type="password" name="inputPassOld" class="form-control" placeholder="Nhập mật khẩu cũ" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Mật khẩu mới:</label>
                        <input type="password" name="inputPassNew" class="form-control" placeholder="Nhập mật khẩu mới" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Xác nhận mật khẩu:</label>
                        <input type="password" name="inputPassComfirm" class="form-control" placeholder="Xác nhận mật khẩu" required>
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-danger">Xác nhận</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        // Disable form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Get the forms we want to add validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

    @if(session()->has('mes'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Đã thay đổi mật khẩu. Vui lòng đăng nhập!',
                showConfirmButton: false,
                timer: 3000
            })
            location.href = "{{ url('logout-admin') }}";
        </script>
    @endif

@endsection
